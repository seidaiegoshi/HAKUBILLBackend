<?php

namespace Database\Factories;

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
    public function definition()
    {
        $price = fake()->randomFloat(7, 10, 10000);
        $cost = fake()->randomFloat(7, 10, 10000);
        $gross_profit = $price - $cost;
        $gross_rate = $gross_profit / $price;
        return [
            "name" => fake()->colorName(),
            // "product_category_id" => \App\Models\ProductCategory::all()->random(1)[0]->id,
            "cost" => fake()->randomFloat(7, 10, 10000),
            "unit" => fake()->randomElement(["袋", "箱", "Kg", "g"]),
            "tax_class" => fake()->randomDigit(),
            "price" => fake()->randomFloat(7, 10, 10000),
            "gross_profit" => $gross_profit,
            "gross_rate" => $gross_rate,
        ];
    }
}
