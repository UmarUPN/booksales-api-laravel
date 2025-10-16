<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

# Author
route::get('/authors', [AuthorController::class, 'index']);
route::post('/authors', [AuthorController::class, 'store']);

# Genre
route::get('/genres', [GenreController::class, 'index']);
route::post('/genres', [GenreController::class, 'store']);

# Book
route::get('/books', [BookController::class, 'index']);
route::post('/books', [BookController::class, 'store']);
