<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Checkout routes
Route::post('/checkout', [CheckoutController::class, 'checkout']);
Route::get('/orders/{order}/status', [CheckoutController::class, 'checkStatus']);
