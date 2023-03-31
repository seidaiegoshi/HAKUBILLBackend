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
        $weight = fake()->randomDigitNotNull();
        $total_cost = $price * 0.3;
        $cost_per_gram = $weight / $total_cost;
        $gross_profit = $price - $total_cost;
        $gross_rate = $gross_profit / $price;
        return [
            "name" => fake()->colorName(),
            "total_cost" => $total_cost,
            "weight" => $weight,
            "cost_per_gram" => $cost_per_gram,
            "unit" => fake()->randomElement(["袋", "箱", "Kg", "g"]),
            "price" => $price,
            "gross_profit" => $gross_profit,
            "gross_rate" => $gross_rate,
        ];
    }
}
