<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    private function getOrCreateCart()
    {
        $sessionId = session()->getId();
        
        return Cart::firstOrCreate(
            ['session_id' => $sessionId],
            ['user_id' => auth()->id()]
        );
    }

    public function index()
    {
        $cart = $this->getOrCreateCart();
        return view('cart.index', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->getOrCreateCart();
        $product = Product::findOrFail($request->product_id);

        // Check if product is already in cart
        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            // Update quantity if product exists
            $cartItem->update([
                'quantity' => $cartItem->quantity + $request->quantity,
            ]);
        } else {
            // Create new cart item
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price,
            ]);
        }

        return response()->json([
            'message' => 'Produto adicionado ao carrinho',
            'cart_count' => $cart->items->sum('quantity')
        ]);
    }

    public function updateQuantity(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->update([
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'message' => 'Quantidade atualizada',
            'subtotal' => number_format($cartItem->subtotal(), 2, ',', '.') . '€',
            'total' => number_format($cartItem->cart->total(), 2, ',', '.') . '€',
            'cart_count' => $cartItem->cart->items->sum('quantity')
        ]);
    }

    public function removeItem(CartItem $cartItem)
    {
        $cart = $cartItem->cart;
        $cartItem->delete();

        return response()->json([
            'message' => 'Produto removido do carrinho',
            'total' => number_format($cart->total(), 2, ',', '.') . '€',
            'cart_count' => $cart->items->sum('quantity')
        ]);
    }
}
