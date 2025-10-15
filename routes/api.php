<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

route::get('/books', [BookController::class, 'index']);
route::get('/authors', [AuthorController::class, 'index']);
route::get('/genres', [GenreController::class, 'index']);
