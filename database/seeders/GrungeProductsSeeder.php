<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class GrungeProductsSeeder extends Seeder
{
    public function run()
    {
        // Get existing categories
        $categories = Category::where('style', 'grunge')->get();
        $categoryMap = [];
        foreach ($categories as $category) {
            $categoryMap[$category->type] = $category;
        }

        // Create products with actual images
        $products = [
            [
                'name' => 'T-Shirt Grunge Barra Rasgada',
                'description' => 'T-shirt com efeito rasgado na barra e visual grunge.',
                'price' => 69.99,
                'image_path' => 'midia/grungeshirt1.jpg',
                'category_id' => $categoryMap['tops']->id,
                'is_available' => true,
                'stock' => 15
            ],
            [
                'name' => 'Calças Grunge Cargo',
                'description' => 'Calças cargo com design grunge e detalhes únicos.',
                'price' => 129.99,
                'image_path' => 'midia/grungepants1.png',
                'category_id' => $categoryMap['bottoms']->id,
                'is_available' => true,
                'stock' => 20
            ]
        ];

        // Products that belong to both Grunge and Streetwear
        $hybridProducts = [
            [
                'name' => 'Calças Grunge e Streetwear',
                'description' => 'Calças com mistura de estilos grunge e streetwear.',
                'price' => 149.99,
                'image_path' => 'midia/streetwear-and-grunge-pants.png',
                'category_id' => $categoryMap['bottoms']->id,
                'is_available' => true,
                'stock' => 18
            ],
            [
                'name' => 'Hoodie Grunge e Streetwear',
                'description' => 'Hoodie com design que mistura elementos grunge e streetwear.',
                'price' => 119.99,
                'image_path' => 'midia/grunge-and-streetwearhoodie.png',
                'category_id' => $categoryMap['tops']->id,
                'is_available' => true,
                'stock' => 25
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        foreach ($hybridProducts as $product) {
            // Create one copy for grunge category (already has grunge category_id)
            Product::create($product);
        }
    }
} 