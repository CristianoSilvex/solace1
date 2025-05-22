<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Controllers\CartController;
use App\Http\Controllers\NewsletterController;

// Default home route
Route::get('/', function () {
    return view('welcome');
});

// Routes for authenticated users (Dashboard)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
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

// Newsletter Routes
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Admin Newsletter Routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/admin/newsletter', [NewsletterController::class, 'showDashboard'])->name('admin.newsletter');
    Route::post('/admin/newsletter/send', [NewsletterController::class, 'sendNewsletter'])->name('admin.newsletter.send');
});
