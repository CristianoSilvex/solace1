<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class OpiumProductsSeeder extends Seeder
{
    public function run()
    {
        // Create categories for each type with opium style
        $categories = [
            [
                'name' => 'Tops Opium',
                'slug' => 'opium-tops',
                'type' => 'tops',
                'style' => 'opium'
            ],
            [
                'name' => 'Calças Opium',
                'slug' => 'opium-bottoms',
                'type' => 'bottoms',
                'style' => 'opium'
            ],
            [
                'name' => 'Casacos Opium',
                'slug' => 'opium-outerwear',
                'type' => 'outerwear',
                'style' => 'opium'
            ],
            [
                'name' => 'Calçado Opium',
                'slug' => 'opium-footwear',
                'type' => 'footwear',
                'style' => 'opium'
            ],
            [
                'name' => 'Chapéus Opium',
                'slug' => 'opium-headwear',
                'type' => 'hats',
                'style' => 'opium'
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

        // Create products with actual images
        $products = [
            [
                'name' => 'Boné Snapback Opium Premium',
                'description' => 'Boné snapback vermelho premium com design exclusivo Opium.',
                'price' => 79.99,
                'image_path' => 'midia/opiumhat2.jpg',
                'category_id' => $categoryMap['hats']->id,
                'is_available' => true,
                'stock' => 20
            ],
            [
                'name' => 'Casaco Bomber Opium',
                'description' => 'Casaco bomber em couro sintético com design moderno e exclusivo.',
                'price' => 279.99,
                'image_path' => 'midia/opiumjacket1.jpg',
                'category_id' => $categoryMap['outerwear']->id,
                'is_available' => true,
                'stock' => 12
            ],
            [
                'name' => 'Calças Cargo Opium Rasgadas',
                'description' => 'Calças cargo com efeito rasgado e múltiplos bolsos.',
                'price' => 189.99,
                'image_path' => 'midia/opiumpants5.jpg',
                'category_id' => $categoryMap['bottoms']->id,
                'is_available' => true,
                'stock' => 14
            ],
            [
                'name' => 'Calças Cargo Opium Utilitárias',
                'description' => 'Calças cargo com múltiplos bolsos e detalhes utilitários.',
                'price' => 209.99,
                'image_path' => 'midia/opiumpants4.jpg',
                'category_id' => $categoryMap['bottoms']->id,
                'is_available' => true,
                'stock' => 12
            ],
            [
                'name' => 'Botas Plataforma Opium',
                'description' => 'Botas plataforma com design exclusivo e acabamento premium.',
                'price' => 289.99,
                'image_path' => 'midia/opiumboots1.png',
                'category_id' => $categoryMap['footwear']->id,
                'is_available' => true,
                'stock' => 7
            ],
            [
                'name' => 'Sapatilhas Opium Chunky',
                'description' => 'Sapatilhas chunky com design robusto e detalhes exclusivos.',
                'price' => 219.99,
                'image_path' => 'midia/opium-grungeboots1.jpg',
                'category_id' => $categoryMap['footwear']->id,
                'is_available' => true,
                'stock' => 11
            ],
            [
                'name' => 'Tank Top Opium Logo',
                'description' => 'Tank top com logo estilizado Opium no peito.',
                'price' => 69.99,
                'image_path' => 'midia/opiumshirt1.jpg',
                'category_id' => $categoryMap['tops']->id,
                'is_available' => true,
                'stock' => 18
            ],
            [
                'name' => 'Casaco Bomber Opium Pelo',
                'description' => 'Casaco bomber com gola de pelo sintético e design oversized.',
                'price' => 349.99,
                'image_path' => 'midia/opiumjacket3.jpg',
                'category_id' => $categoryMap['outerwear']->id,
                'is_available' => true,
                'stock' => 8
            ],
            [
                'name' => 'Botas Opium Canvas',
                'description' => 'Botas em canvas com sola robusta e acabamento premium.',
                'price' => 259.99,
                'image_path' => 'midia/opiumboots3.jpg',
                'category_id' => $categoryMap['footwear']->id,
                'is_available' => true,
                'stock' => 10
            ],
            [
                'name' => 'Calças Opium Largas em Couro',
                'description' => 'Calças largas em couro sintético com visual marcante.',
                'price' => 229.99,
                'image_path' => 'midia/opiumpants3.jpg',
                'category_id' => $categoryMap['bottoms']->id,
                'is_available' => true,
                'stock' => 11
            ],
            [
                'name' => 'Calças Opium Flare em Couro',
                'description' => 'Calças flare em couro sintético com corte ajustado.',
                'price' => 239.99,
                'image_path' => 'midia/opiumpants2.png',
                'category_id' => $categoryMap['bottoms']->id,
                'is_available' => true,
                'stock' => 10
            ],
            [
                'name' => 'Chapéu Opium Chifres',
                'description' => 'Chapéu com chifres em couro sintético, visual exclusivo.',
                'price' => 99.99,
                'image_path' => 'midia/opiumhat1.jpg',
                'category_id' => $categoryMap['hats']->id,
                'is_available' => true,
                'stock' => 7
            ],
            [
                'name' => 'Botas Opium com Fecho',
                'description' => 'Botas com fecho lateral e atacadores contrastantes.',
                'price' => 269.99,
                'image_path' => 'midia/opiumboots2.jpg',
                'category_id' => $categoryMap['footwear']->id,
                'is_available' => true,
                'stock' => 9
            ],
            [
                'name' => 'Botas Plataforma Opium Pretas',
                'description' => 'Botas plataforma pretas com design exclusivo e acabamento premium.',
                'price' => 299.99,
                'image_path' => 'midia/opiumboots4.jpg',
                'category_id' => $categoryMap['footwear']->id,
                'is_available' => true,
                'stock' => 8
            ],
            [
                'name' => 'Calças Largas Rick Opium',
                'description' => 'Calças largas em couro preto com design inspirado em Rick Owens, corte oversized e acabamento premium.',
                'price' => 249.99,
                'image_path' => 'midia/rickleatherbaggypants.jpg',
                'category_id' => $categoryMap['bottoms']->id,
                'is_available' => true,
                'stock' => 15
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
} 