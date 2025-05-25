<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class StreetWearProductsSeeder extends Seeder
{
    public function run(): void
    {
        // Get existing categories
        $categories = Category::where('style', 'streetwear')->get();
        
        // Map categories by type
        $categoryMap = [];
        foreach ($categories as $category) {
            $categoryMap[$category->type] = $category;
        }

        // Make sure we have all required categories
        if (!isset($categoryMap['tops']) || !isset($categoryMap['bottoms']) || !isset($categoryMap['outerwear'])) {
            // Create missing categories if needed
            if (!isset($categoryMap['tops'])) {
                $categoryMap['tops'] = Category::create([
                    'name' => 'Camisolas Streetwear',
                    'slug' => 'streetwear-tops',
                    'type' => 'tops',
                    'style' => 'streetwear'
                ]);
            }
            if (!isset($categoryMap['bottoms'])) {
                $categoryMap['bottoms'] = Category::create([
                    'name' => 'Calças Streetwear',
                    'slug' => 'streetwear-bottoms',
                    'type' => 'bottoms',
                    'style' => 'streetwear'
                ]);
            }
            if (!isset($categoryMap['outerwear'])) {
                $categoryMap['outerwear'] = Category::create([
                    'name' => 'Casacos Streetwear',
                    'slug' => 'streetwear-outerwear',
                    'type' => 'outerwear',
                    'style' => 'streetwear'
                ]);
            }
        }

        $products = [
            [
                'name' => 'Sweatshirt Streetwear Clássica',
                'description' => 'Sweatshirt streetwear com design clássico e conforto de qualidade superior.',
                'price' => 89.99,
                'image_path' => 'midia/streetwearhoodie.png',
                'category_id' => $categoryMap['tops']->id,
                'is_available' => true,
                'stock' => 25
            ],
            [
                'name' => 'Sweatshirt Streetwear Larga',
                'description' => 'Sweatshirt streetwear com corte largo e acabamento de qualidade superior.',
                'price' => 94.99,
                'image_path' => 'midia/streetwearhoodie1.png',
                'category_id' => $categoryMap['tops']->id,
                'is_available' => true,
                'stock' => 20
            ],
            [
                'name' => 'Sweatshirt Streetwear Premium',
                'description' => 'Sweatshirt streetwear premium com design exclusivo.',
                'price' => 99.99,
                'image_path' => 'midia/streetwearhoodie2.png',
                'category_id' => $categoryMap['tops']->id,
                'is_available' => true,
                'stock' => 18
            ],
            [
                'name' => 'Casaco Streetwear Clássico',
                'description' => 'Casaco streetwear com design clássico e acabamento de qualidade superior.',
                'price' => 159.99,
                'image_path' => 'midia/streetwearjacket.png',
                'category_id' => $categoryMap['outerwear']->id,
                'is_available' => true,
                'stock' => 15
            ],
            [
                'name' => 'Casaco Streetwear Premium',
                'description' => 'Casaco streetwear premium com detalhes exclusivos.',
                'price' => 179.99,
                'image_path' => 'midia/streetwearjacket1.png',
                'category_id' => $categoryMap['outerwear']->id,
                'is_available' => true,
                'stock' => 12
            ],
            [
                'name' => 'Calças Cargo Streetwear',
                'description' => 'Calças cargo streetwear com vários bolsos.',
                'price' => 129.99,
                'image_path' => 'midia/streetwearpants.png',
                'category_id' => $categoryMap['bottoms']->id,
                'is_available' => true,
                'stock' => 20
            ],
            [
                'name' => 'Polo Streetwear Premium',
                'description' => 'Polo streetwear com design moderno e tecido de qualidade superior.',
                'price' => 79.99,
                'image_path' => 'midia/streetwearpolo.png',
                'category_id' => $categoryMap['tops']->id,
                'is_available' => true,
                'stock' => 22
            ],
            [
                'name' => 'T-shirt Streetwear Básica',
                'description' => 'T-shirt streetwear básica com corte moderno.',
                'price' => 59.99,
                'image_path' => 'midia/streetwearshirt.png',
                'category_id' => $categoryMap['tops']->id,
                'is_available' => true,
                'stock' => 30
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
                'name' => 'Sweatshirt Grunge e Streetwear',
                'description' => 'Sweatshirt com design que mistura elementos grunge e streetwear.',
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
            // Create one copy for streetwear category
            Product::create($product);
        }
    }
} 