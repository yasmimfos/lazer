<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get("/users", [UserController::class, 'index']);
Route::post("/users", [UserController::class, 'store']);

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users/user', [UserController::class, 'show']);
    Route::put('/users', [UserController::class, 'update']);
    Route::delete('/users', [UserController::class, 'destroy']);

    Route::get('/books', [BooksController::class, 'index']);
    Route::post('/books', [BooksController::class, 'store']);
    Route::get('/books/{id}', [BooksController::class, 'show']);
    Route::put('/books/{id}', [BooksController::class, 'update']);
    Route::delete('/books/{id}', [BooksController::class, 'destroy']);

    Route::get('/movies/{id}', [MoviesController::class, 'show']);
    Route::get('/movies', [MoviesController::class, 'index']);
    Route::post('/movies', [MoviesController::class, 'store']);
    Route::put('/movies/{id}', [MoviesController::class, 'update']);
    Route::delete('/movies/{id}', [MoviesController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
