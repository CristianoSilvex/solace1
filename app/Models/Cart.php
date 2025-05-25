<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $fillable = [
        'session_id',
        'user_id',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function total(): float
    {
        // Ensure we're using fresh data
        $this->load('items.product');
        
        return $this->items->sum(function ($item) {
            // Always use the current product price
            $currentPrice = $item->product->price;
            // Update the cart item price if it's different
            if ($item->price != $currentPrice) {
                $item->update(['price' => $currentPrice]);
            }
            return $currentPrice * $item->quantity;
        });
    }
}
