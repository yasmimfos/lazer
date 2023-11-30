<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get("/users", [UserController::class, 'index']);
Route::post("/users", [UserController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/books', [BooksController::class, 'index']);
Route::post('/books', [BooksController::class, 'store']);
Route::get('/books/{id}', [BooksController::class, 'show']);
Route::put('/books/{id}', [BooksController::class, 'update']);
Route::delete('/books/{id}', [BooksController::class, 'destroy']);

Route::get('/movies', [MoviesController::class, 'index']);
Route::post('/movies', [MoviesController::class, 'store']);
Route::get('/movies/{id}', [MoviesController::class, 'show']);
Route::get('/movies/{id}', [MoviesController::class, 'show']);
Route::put('/movies/{id}', [MoviesController::class, 'update']);
Route::delete('/movies/{id}', [MoviesController::class, 'destroy']);