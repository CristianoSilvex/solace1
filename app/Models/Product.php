<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image_path',
        'category_id',
        'is_available',
        'stock'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
        'stock' => 'integer'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
