<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Models\Cart;

// Default home route
Route::get('/', function () {
    return view('welcome');
});

// Home route for post-login/register redirection
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Dashboard route
Route::middleware(['auth'])->get('/dashboard', function () {
    $cart = Cart::where('session_id', session()->getId())->first();
    if ($cart && $cart->items()->count() > 0) {
        return redirect()->route('checkout.show');
    }
    return view('dashboard');
})->name('dashboard');

// Checkout Routes (Protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout.show');
    Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/checkout/confirmation/{order}', [CheckoutController::class, 'showConfirmation'])->name('checkout.confirmation');
});

// About page route
Route::get('/about', function () {
    return view('about');
});

// Display the Contact Page
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Display all clothing
Route::get('/clothing', [ProductController::class, 'index'])->name('clothing');

// Handle Contact form submission via ContactController
Route::post('/contact/send', [ContactController::class, 'send'])
    ->name('contact.send')
    ->middleware(['web', 'throttle:3,1']);

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::patch('/cart/items/{cartItem}/quantity', [CartController::class, 'updateQuantity'])->name('cart.update-quantity');
Route::delete('/cart/items/{cartItem}', [CartController::class, 'removeItem'])->name('cart.remove-item');
