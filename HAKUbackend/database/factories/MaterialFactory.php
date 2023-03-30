<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => fake()->word(),
            "unit" => fake()->randomElement(["袋", "箱", "Kg", "g"]),
            "price" => fake()->randomFloat(7, 10, 10000),
            "yield" => fake()->randomElement([1, 0.9, 0.8, 0.7, 0.6]),
        ];
    }
}
