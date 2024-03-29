<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Material;
use \App\Models\Product;
use \App\Models\MaterialProduct;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MaterialProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $materialId = Product::inRandomOrder()->first()->id;
        $productId = Product::inRandomOrder()->first()->id;

        while (MaterialProduct::where('material_id', $materialId)->where('product_id', $productId)->exists()) {
            $materialId = Product::inRandomOrder()->first()->id;
            $productId = Product::inRandomOrder()->first()->id;
        }

        return [
            "material_id" => $materialId,
            "product_id" => $productId,
            "yield_rate" => fake()->randomFloat(4, 0, 1),
            "usage_rate" => fake()->randomFloat(4, 0, 1),
        ];
    }
}
