<?php

use App\Http\Controllers\API\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/books', [BookController::class, 'index']); 
Route::post('/books', [BookController::class, 'store']); 
Route::get('/books/{id}', [BookController::class, 'show']); 
Route::match(['put', 'patch'],'/books/{id}', [BookController::class, 'update']); 
Route::delete('/books/{id}', [BookController::class, 'destroy']); 