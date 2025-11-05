<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// ==========================================================

# Public Routes
Route::middleware('guest')->group(function () { // guest = hanya user yang belum login yang bisa mengakses
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});
Route::apiResource('/users', UserController::class)->only(['index', 'show']);
Route::apiResource('/authors', AuthorController::class)->only(['index', 'show']);
Route::apiResource('/genres', GenreController::class)->only(['index', 'show']);
Route::apiResource('/books', BookController::class)->only(['index', 'show']);


Route::middleware(['auth:api'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Cart routes
    Route::get('/cart-items', [CartItemController::class, 'userCart']);
    Route::post('/cart-items', [CartItemController::class, 'store']);
    Route::get('/cart-items/{id}', [CartItemController::class, 'show']);
    Route::post('/cart-items/{id}', [CartItemController::class, 'update']);
    Route::delete('/cart-items/{id}', [CartItemController::class, 'destroy']);
    Route::delete('/cart-items/clear/all', [CartItemController::class, 'clearCart']);

    // Admin only routes
    // Route::get('/admin/cart-items', [CartItemController::class, 'index'])->middleware('admin');

    Route::apiResource('/transactions', TransactionController::class)->only(['index', 'store', 'update', 'show']);

    Route::middleware(['role:admin'])->group(function () {
        Route::apiResource('/users', UserController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('/authors', AuthorController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('/genres', GenreController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('/books', BookController::class)->only(['store', 'update', 'destroy']);
        Route::get('/admin/cart-items', [CartItemController::class, 'index']);
        Route::apiResource('/transactions', TransactionController::class)->only(['destroy']);
    });

});
// ==========================================================

// Route::middleware(['auth:api'])->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout']);
// });

// Route::apiResource('/users', AuthorController::class);
// Route::apiResource('/authors', AuthorController::class);
// Route::apiResource('/genres', GenreController::class);
// Route::apiResource('/books', BookController::class);
// Route::apiResource('/transactions', TransactionController::class);
