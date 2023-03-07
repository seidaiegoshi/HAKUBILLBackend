<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerPrice>
 */
class CustomerPriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "customer_id" => \App\Models\Customer::all()->random(1)[0]->id,
            "product_id" => \App\Models\Product::all()->random(1)[0]->id,
            "price" => fake()->randomFloat(7, 10, 10000),
        ];
    }
}
