<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign key checks
        Schema::disableForeignKeyConstraints();

        // Clear existing data
        DB::table('products')->truncate();
        DB::table('categories')->truncate();
        
        // First seed the categories
        $this->call([
            CategorySeeder::class,
        ]);

        // Then seed the products
        $this->call([
            GrungeProductsSeeder::class,
            StreetWearProductsSeeder::class,
            OpiumProductsSeeder::class,
        ]);

        // Re-enable foreign key checks
        Schema::enableForeignKeyConstraints();
    }
}
