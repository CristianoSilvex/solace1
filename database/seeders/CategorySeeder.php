<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Grunge categories
        Category::create([
            'name' => 'Camisolas Grunge',
            'slug' => 'grunge-tops',
            'type' => 'tops',
            'style' => 'grunge'
        ]);

        Category::create([
            'name' => 'Calças Grunge',
            'slug' => 'grunge-bottoms',
            'type' => 'bottoms',
            'style' => 'grunge'
        ]);

        Category::create([
            'name' => 'Casacos Grunge',
            'slug' => 'grunge-outerwear',
            'type' => 'outerwear',
            'style' => 'grunge'
        ]);

        // Streetwear categories
        Category::create([
            'name' => 'Camisolas Streetwear',
            'slug' => 'streetwear-tops',
            'type' => 'tops',
            'style' => 'streetwear'
        ]);

        Category::create([
            'name' => 'Calças Streetwear',
            'slug' => 'streetwear-bottoms',
            'type' => 'bottoms',
            'style' => 'streetwear'
        ]);

        Category::create([
            'name' => 'Casacos Streetwear',
            'slug' => 'streetwear-outerwear',
            'type' => 'outerwear',
            'style' => 'streetwear'
        ]);
    }
} 