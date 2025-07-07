<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $adjectives = ['Smart', 'Pro', 'Ultra', 'Eco', 'Max', 'Plus'];
        $products = ['TV', 'Notebook', 'Fone', 'Celular', 'Relógio', 'Monitor'];

        $name = $this->faker->randomElement($adjectives) . ' ' . $this->faker->randomElement($products);

        return [
            'name' => $name,
            'price' => $this->faker->randomFloat(2, 100, 5000),
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ];
    }
}
