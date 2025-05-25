<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'payment_method',
        'amount',
        'status',
        'reference', // For Multibanco reference
        'entity',    // For Multibanco entity
        'phone',     // For MB WAY
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    // Payment method constants
    const METHOD_MULTIBANCO = 'multibanco';
    const METHOD_MBWAY = 'mbway';
    const METHOD_CREDIT_CARD = 'credit_card';

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
} 