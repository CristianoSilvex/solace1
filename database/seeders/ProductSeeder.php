<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            // Create 3 products for each category
            for ($i = 1; $i <= 3; $i++) {
                Product::create([
                    'name' => $category->name . ' ' . $i,
                    'description' => 'High-quality ' . $category->name . ' with unique design ' . $i,
                    'price' => rand(2999, 9999) / 100, // Random price between $29.99 and $99.99
                    'image_path' => 'images/products/' . $category->slug . '-' . $i . '.jpg',
                    'category_id' => $category->id,
                    'is_available' => true,
                    'stock' => rand(5, 50)
                ]);
            }
        }
    }
} 