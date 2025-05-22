<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class GrungeProductsSeeder extends Seeder
{
    public function run()
    {
        // Create categories for each type with grunge style
        $categories = [
            [
                'name' => 'Tops Grunge',
                'slug' => 'grunge-tops',
                'type' => 'tops',
                'style' => 'grunge'
            ],
            [
                'name' => 'Calças Grunge',
                'slug' => 'grunge-bottoms',
                'type' => 'bottoms',
                'style' => 'grunge'
            ],
            [
                'name' => 'Casacos Grunge',
                'slug' => 'grunge-outerwear',
                'type' => 'outerwear',
                'style' => 'grunge'
            ],
            [
                'name' => 'Calçado Grunge',
                'slug' => 'grunge-footwear',
                'type' => 'footwear',
                'style' => 'grunge'
            ],
            [
                'name' => 'Chapéus Grunge',
                'slug' => 'grunge-headwear',
                'type' => 'hats',
                'style' => 'grunge'
            ]
        ];

        $categoryMap = [];
        foreach ($categories as $categoryData) {
            $category = Category::firstOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );
            $categoryMap[$categoryData['type']] = $category;
        }

        // Create only the ripped bottom t-shirt product
        $product = [
            'name' => 'T-Shirt Grunge Barra Rasgada',
            'description' => 'T-shirt com efeito rasgado na barra e visual grunge.',
            'price' => 69.99,
            'image_path' => 'midia/grungeshirt1.jpg',
            'category_id' => $categoryMap['tops']->id,
            'is_available' => true,
            'stock' => 15
        ];

        Product::create($product);
    }
} 