<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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

        try {
            DB::beginTransaction();

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

            // Refresh cart to get updated totals
            $cart->refresh();
            
            DB::commit();

            return response()->json([
                'message' => 'Product added to cart successfully',
                'cart_count' => $cart->items->sum('quantity')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error adding to cart: ' . $e->getMessage());
            return response()->json([
                'message' => 'Error adding to cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateQuantity(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            // Get fresh price from product to ensure accuracy
            $product = Product::findOrFail($cartItem->product_id);
            
            // Update the quantity and ensure price is current
            $cartItem->update([
                'quantity' => $request->quantity,
                'price' => $product->price // Ensure we're using current price
            ]);

            // Refresh the cart and cart item to get updated totals
            $cart = $cartItem->cart;
            $cartItem->refresh();
            $cart->refresh();

            // Calculate new totals
            $itemSubtotal = number_format($cartItem->subtotal(), 2, ',', '.');
            $cartTotal = number_format($cart->total(), 2, ',', '.');
            $cartCount = $cart->items->sum('quantity');

            DB::commit();

            return response()->json([
                'message' => 'Quantity updated successfully',
                'subtotal' => $itemSubtotal . '€',
                'total' => $cartTotal . '€',
                'cart_count' => $cartCount
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error updating cart quantity: ' . $e->getMessage());
            return response()->json([
                'message' => 'Error updating quantity',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function removeItem(CartItem $cartItem)
    {
        try {
            DB::beginTransaction();

            $cart = $cartItem->cart;
            $cartItem->delete();

            // Refresh the cart to get updated totals
            $cart->refresh();

            $cartTotal = number_format($cart->total(), 2, ',', '.');
            $cartCount = $cart->items->sum('quantity');

            DB::commit();

            return response()->json([
                'message' => 'Item removed successfully',
                'total' => $cartTotal . '€',
                'cart_count' => $cartCount
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error removing cart item: ' . $e->getMessage());
            return response()->json([
                'message' => 'Error removing item',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
