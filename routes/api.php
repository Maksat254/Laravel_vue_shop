<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\CartController;
use \App\Http\Controllers\Api\CommentController;

Route::get("/test-me", function () {
    return response()->json(["Hello from laravel"]);
});

Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('create', [ProductController::class, 'create'])->name('product.create');
Route::post('/products/add', [ProductController::class, 'store'])->name('product.store');
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('products/detail/{product}', [ProductController::class, 'detail'])->name('product.detale');
Route::post('create/comment', [CommentController::class, 'comment'])->name('create.comment');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/orders', [OrderController::class, 'create'])->middleware('auth:sanctum')->name('order.create');
Route::delete('/products/{id}', [ProductController::class, 'destroy']);


Route::post('/register', [AuthController::class, 'register'])->name('auth.register')->name('auth.register');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login')->name('auth.login')->name('auth.login');
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'getUser'])->name('get-user');
