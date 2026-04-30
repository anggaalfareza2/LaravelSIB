<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
// Public routes — tanpa auth
Route::apiResource('/books', BookController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
Route::apiResource('/genres', GenreController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
Route::apiResource('/authors', AuthorController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

// Customer routes
Route::middleware(['auth:api', 'checkRole:customer'])->group(function () {
    Route::apiResource('/transactions', TransactionController::class)->only(['store', 'show', 'update']);
});

// Admin only routes
Route::middleware(['auth:api', 'checkRole:admin'])->group(function () {
    Route::apiResource('/transactions', TransactionController::class)->only(['index', 'destroy']);
});