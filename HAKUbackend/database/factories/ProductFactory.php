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
        return [
            "name" => fake()->colorName(),
            "cost" => fake()->randomFloat(7, 10, 10000),
            "unit" => fake()->randomElement(["袋", "箱", "Kg", "g"]),
            "tax_class" => fake()->randomDigit(),
            "price" => fake()->randomFloat(7, 10, 10000),
        ];
    }
}
