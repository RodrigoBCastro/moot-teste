<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = Category::factory(10)->create();

        $brands = Brand::factory(15)->create();

        Product::factory(100)->create([
            'category_id' => $categories->random()->id,
            'brand_id' => $brands->random()->id,
        ]);
    }
}
