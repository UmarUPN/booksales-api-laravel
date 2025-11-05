<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartItemController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('book', 'user')->get();

        return $cartItems->isNotEmpty()
        ?
            response()->json([
                'status' => true,
                'message' => 'Get All Resource',
                'data' => $cartItems
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
        # 1. validator
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);

        # 2. check validator error
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        # 3. Check if item already exists in cart for this user
        $existingCartItem = CartItem::where('user_id', auth()->id()) // Filter: hanya data yang kolom user_id-nya sama dengan ID user yang sedang login (auth()->id()).
            ->where('book_id', $request->book_id) // Filter lagi: hanya data dengan book_id yang sama seperti yang dikirim lewat request.
            ->first(); // Ambil satu baris pertama yang cocok dengan kriteria itu. Jika tidak ada data yang cocok, hasilnya null.

        if ($existingCartItem) {
            # Update quantity if item already exists
            $existingCartItem->update([
                'quantity' => $existingCartItem->quantity + $request->quantity
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Cart Item Quantity Updated Successfully!',
                'data' => $existingCartItem->load('book')
            ], 200);
        }

        # 4. insert data
        $cartItem = CartItem::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'quantity' => $request->quantity
        ]);

        # 5. response
        return response()->json([
            'status' => true,
            'message' => 'Resource Added Successfully!',
            'data' => $cartItem->load('book')
        ], 201);
    }

    public function show(string $id)
    {
        $cartItem = CartItem::with('book', 'user')->find($id);

        # Check if cart item belongs to authenticated user
        if ($cartItem && $cartItem->user_id !== auth()->id()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized Access!'
            ], 403);
        }

        return $cartItem
        ?
            response()->json([
                'status' => true,
                'message' => 'Get Detail Resource',
                'data' => $cartItem
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
        # 1. mencari data
        $cartItem = CartItem::with('book')->find($id);

        if (!$cartItem) {
            return response()->json([
                'status' => false,
                'message' => 'Resource Not Found!'
            ], 404);
        }

        # 2. Check authorization
        if ($cartItem->user_id !== auth()->id()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized Access!'
            ], 403);
        }

        # 3. validator
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 422);
        }

        # 4. update data
        $cartItem->update([
            'quantity' => $request->quantity
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Resource Updated Successfully!',
            'data' => $cartItem
        ], 200);
    }

    public function destroy(string $id)
    {
        $cartItem = CartItem::find($id);

        if (!$cartItem) {
            return response()->json([
                'status' => false,
                'message' => 'Resource Not Found!'
            ], 404);
        }

        # Check authorization
        if ($cartItem->user_id !== auth()->id()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized Access!'
            ], 403);
        }

        $cartItem->delete();

        return response()->json([
            'status' => true,
            'message' => 'Delete Resource Successfully'
        ], 200);
    }

    /**
     * Get cart items for authenticated user
     */
    public function userCart()
    {
        $cartItems = CartItem::with('book.author', 'book.genre')
            ->where('user_id', auth()->id())
            ->get();

        return $cartItems->isNotEmpty()
        ?
            response()->json([
                'status' => true,
                'message' => 'Get User Cart Items',
                'data' => $cartItems
            ], 200)
        :
            response()->json([
                'status' => true,
                'message' => 'Cart is Empty',
                'data' => []
            ], 200)
        ;
    }

    /**
     * Clear all cart items for authenticated user
     */
    public function clearCart()
    {
        $deleted = CartItem::where('user_id', auth()->id())->delete();

        return response()->json([
            'status' => true,
            'message' => 'Cart Cleared Successfully',
            'deleted_count' => $deleted
        ], 200);
    }
}
