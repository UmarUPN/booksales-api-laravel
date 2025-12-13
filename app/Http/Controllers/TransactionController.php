<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\CartItem;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'items.book'])->get();

        return $transactions->isNotEmpty()
        ?
            response()->json([
                'status' => true,
                'message' => 'Get All Resource',
                'data' => $transactions
            ], 200)
        :
            response()->json([
                'status' => true,
                'message' => 'Resource Data Not Found'
            ], 200)
        ;
    }

    public function store(Request $request)
    {
        # 1. Get user's cart items
        $cartItems = CartItem::with('book.author')->where('user_id', auth()->id())->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Cart is empty'
            ], 400);
        }

        # 2. Validate stock availability
        foreach ($cartItems as $cartItem) {
            if ($cartItem->book->stock < $cartItem->quantity) {
                return response()->json([
                    'status' => false,
                    'message' => "Insufficient stock for '{$cartItem->book->title}'. Available: {$cartItem->book->stock}, Requested: {$cartItem->quantity}"
                ], 400);
            }
        }

        # 3. Calculate total amount
        $totalAmount = $cartItems->sum(function ($item) {
            return $item->book->price * $item->quantity;
        });

        # 4. Create transaction
        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'transaction_code' => 'INV-' . strtoupper(uniqid()),
            'total_amount' => $totalAmount,
            'status' => 'pending'
        ]);

        # 5. Create transaction items and update book stock
        foreach ($cartItems as $cartItem) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'book_id' => $cartItem->book_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->book->price,
                'book_title' => $cartItem->book->title, // nyambung antar model
                'author_name' => $cartItem->book->author->name // $cartItem->book->author->name digunakan untuk mengambil nama penulis dari relasi 'author' pada model 'Book'.
            ]);

            # Update book stock
            $cartItem->book->decrement('stock', $cartItem->quantity);
        }

        # 6. Clear user's cart
        CartItem::where('user_id', auth()->id())->delete();

        # 7. Load relationship for response
        $transaction->load('items.book');

        return response()->json([
            'status' => true,
            'message' => 'Transaction Created Successfully!',
            'data' => $transaction
        ], 201);
    }

    public function show(string $id)
    {
        $transaction = Transaction::with(['user', 'items.book'])->find($id);

        if (!$transaction) {
            return response()->json([
                'status' => false,
                'message' => 'Resource Not Found!'
            ], 404);
        }

        # Check authorization (user can only see their own transactions, admin can see all)
        if (auth()->user()->role !== 'admin' && $transaction->user_id !== auth()->id()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized Access!'
            ], 403);
        }

        return response()->json([
            'status' => true,
            'message' => 'Get Detail Resource',
            'data' => $transaction
        ], 200);
    }

    public function update(string $id, Request $request)
    {
        # 1. Find transaction
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'status' => false,
                'message' => 'Resource Not Found!'
            ], 404);
        }

        # 2. Validator
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,paid,cancelled'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 422);
        }

        # 3. Handle status change to 'paid' - update user balances
        if ($request->status === 'paid' && $transaction->status !== 'paid') {
            DB::beginTransaction();
            try {
                # Get current user and admin
                $user = User::find($transaction->user_id);
                $admin = User::find(1); // Admin user with ID 1

                if (!$user || !$admin) {
                    return response()->json([
                        'status' => false,
                        'message' => 'User or admin not found'
                    ], 404);
                }

                # Check if user has sufficient balance
                if ($user->balance < $transaction->total_amount) {
                    return response()->json([
                        'status' => false,
                        'message' => "Insufficient balance to complete payment. Your Balance: {$user->balance}, Total Payment Required: {$transaction->total_amount}"
                    ], 400);
                }

                # Update balances
                $user->decrement('balance', $transaction->total_amount);
                $admin->increment('balance', $transaction->total_amount);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to update balances: ' . $e->getMessage()
                ], 500);
            }
        }

        # 4. Handle status change to 'cancelled' - restore book stock and refund if was paid
        if ($request->status === 'cancelled' && $transaction->status !== 'cancelled') {
            DB::beginTransaction();
            try {
                # If transaction was paid, refund the money
                if ($transaction->status === 'paid') {
                    $user = User::find($transaction->user_id);
                    $admin = User::find(1);

                    if ($user && $admin) {
                        # Refund user and deduct from admin
                        $user->increment('balance', $transaction->total_amount);
                        $admin->decrement('balance', $transaction->total_amount);
                    }
                }

                # Restore book stock
                foreach ($transaction->items as $item) {
                    Book::where('id', $item->book_id)->increment('stock', $item->quantity);
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to cancel transaction: ' . $e->getMessage()
                ], 500);
            }
        }

        # 5. Handle status change from 'cancelled' to other status - deduct stock again
        if ($transaction->status === 'cancelled' && $request->status !== 'cancelled') {
            foreach ($transaction->items as $item) {
                $book = Book::find($item->book_id);
                if ($book->stock < $item->quantity) {
                    return response()->json([
                        'status' => false,
                        'message' => "Cannot change status. Insufficient stock for '{$item->book_title}'. Available: {$book->stock}, Required: {$item->quantity}"
                    ], 400);
                }
                $book->decrement('stock', $item->quantity);
            }
        }

        # 6. Update transaction status
        $transaction->update([
            'status' => $request->status
        ]);

        # 7. Load relationship for response
        $transaction->load('items.book');

        return response()->json([
            'status' => true,
            'message' => 'Resource Updated Successfully!',
            'data' => $transaction
        ], 200);
    }

    public function destroy(string $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'status' => false,
                'message' => 'Resource Not Found!'
            ], 404);
        }

        # Restore book stock if transaction is not cancelled
        if ($transaction->status !== 'cancelled') {
            foreach ($transaction->items as $item) {
                Book::where('id', $item->book_id)->increment('stock', $item->quantity);
            }
        }

        $transaction->delete();

        return response()->json([
            'status' => true,
            'message' => 'Delete Resource Successfully'
        ], 200);
    }
}
