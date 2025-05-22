<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // Tops
            ['name' => 'Opium T-Shirt', 'slug' => 'opium-tshirt', 'type' => 'tops', 'style' => 'opium'],
            ['name' => 'Grunge Hoodie', 'slug' => 'grunge-hoodie', 'type' => 'tops', 'style' => 'grunge'],
            ['name' => 'Streetwear Jacket', 'slug' => 'streetwear-jacket', 'type' => 'tops', 'style' => 'streetwear'],
            ['name' => 'USA Flag Shirt', 'slug' => 'usa-flag-shirt', 'type' => 'tops', 'style' => 'usa_drip'],

            // Bottoms
            ['name' => 'Opium Pants', 'slug' => 'opium-pants', 'type' => 'bottoms', 'style' => 'opium'],
            ['name' => 'Grunge Jeans', 'slug' => 'grunge-jeans', 'type' => 'bottoms', 'style' => 'grunge'],
            ['name' => 'Streetwear Cargos', 'slug' => 'streetwear-cargos', 'type' => 'bottoms', 'style' => 'streetwear'],
            ['name' => 'USA Flag Shorts', 'slug' => 'usa-flag-shorts', 'type' => 'bottoms', 'style' => 'usa_drip'],

            // Hats
            ['name' => 'Opium Cap', 'slug' => 'opium-cap', 'type' => 'hats', 'style' => 'opium'],
            ['name' => 'Grunge Beanie', 'slug' => 'grunge-beanie', 'type' => 'hats', 'style' => 'grunge'],
            ['name' => 'Streetwear Snapback', 'slug' => 'streetwear-snapback', 'type' => 'hats', 'style' => 'streetwear'],
            ['name' => 'USA Flag Hat', 'slug' => 'usa-flag-hat', 'type' => 'hats', 'style' => 'usa_drip'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
} 