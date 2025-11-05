<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        $transaction = Transaction::with('user', 'book')->get();

        return $transaction->isNotEmpty()
        ?
            response()->json([
                'status' => true,
                'message' => 'Get All Resource',
                'data' => $transaction
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
        # 1. validator dan cek validator
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 422);
        }

        # 2. generate order_number -> unique | ORD-0243254464
        $uniqueCode = "ORD-" . strtoupper(uniqid());

        # 3. ambil user yang sedang login & cek login (apakah ada data user)
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized!'
            ], 401);
        }

        # 4. mencari data buku dari request
        $book = Book::find($request->book_id);

        # 5. cek stok buku
        if ($book->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stok buku tidak cukup'
            ], 400);
        }

        # 6. hitung total harga
        $totalAmount = $book->price * $request->quantity;

        # 7. kurangi stok di database
        $book->stock -= $request->quantity;
        $book->save();

        # 8. simpan data transaksi
        $transaction = Transaction::create([
            'order_number' => $uniqueCode,
            'customer_id' => $user->id,
            'book_id' => $request->book_id,
            'total_amount' => $totalAmount
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaction created successfully!',
            'data' => $transaction
        ], 201);
    }

    public function show(string $id)
    {
        $transaction = Transaction::with('user', 'book')->find($id);

        return $transaction
        ?
            response()->json([
                'status' => true,
                'message' => 'Get Detail Resource',
                'data' => $transaction
            ], 200)
        :
            response()->json([
                'status' => false,
                'message' => 'Resource Not Found!'
            ], 404)
        ;
    }

    public function update(string $id, Request $request)
    {
        # 1. cari transaksi
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'status' => false,
                'message' => 'Resource Not Found!'
            ], 404);
        }

        # 2. validasi input
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 422);
        }

        # 3. kembalikan stok buku lama
        $oldBook = Book::find($transaction->book_id);
        $oldQuantity = $transaction->total_amount / $oldBook->price; // jumlah lama
        $oldBook->stock += $oldQuantity;
        $oldBook->save();

        # 4. cek stok buku baru
        $newBook = Book::find($request->book_id);
        if ($newBook->stock < $request->quantity) {
            // kembalikan stok lama jika gagal
            $oldBook->stock -= $oldQuantity;
            $oldBook->save();

            return response()->json([
                'status' => false,
                'message' => 'Stok buku tidak cukup'
            ], 400);
        }

        # 5. hitung total baru dan kurangi stok buku baru
        $totalAmount = $newBook->price * $request->quantity;
        $newBook->stock -= $request->quantity;
        $newBook->save();

        # 6. update transaksi
        $transaction->update([
            'book_id' => $request->book_id,
            'total_amount' => $totalAmount
        ]);

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

        DB::transaction(function () use ($transaction) {
            $book = Book::find($transaction->book_id);
            $previousQuantity = $transaction->total_amount / $book->price;

            $book->stock += $previousQuantity;
            $book->save();

            $transaction->delete();
        });

        return response()->json([
            'status' => true,
            'message' => 'Resource Deleted Successfully!'
        ], 200);
    }

}
