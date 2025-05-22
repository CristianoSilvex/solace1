<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Cart;

class ShareCart
{
    public function handle(Request $request, Closure $next)
    {
        $sessionId = session()->getId();
        $cart = Cart::firstOrCreate(['session_id' => $sessionId]);

        if (auth()->check() && !$cart->user_id) {
            $cart->update(['user_id' => auth()->id()]);
        }

        view()->share('cart', $cart);

        return $next($request);
    }
} 