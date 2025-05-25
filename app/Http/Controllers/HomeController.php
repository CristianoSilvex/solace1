<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->check()) {
            $cart = Cart::where('session_id', session()->getId())->first();
            if ($cart && $cart->items()->count() > 0) {
                return redirect()->route('checkout.show');
            }
            return redirect()->route('dashboard');
        }
        return redirect()->route('login');
    }
} 