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
        $customerId = \App\Models\Customer::inRandomOrder()->first()->id;
        $productId = \App\Models\Product::inRandomOrder()->first()->id;

        while (\App\Models\CustomerPrice::where('customer_id', $customerId)->where('product_id', $productId)->exists()) {
            $customerId = \App\Models\Customer::inRandomOrder()->first()->id;
            $productId = \App\Models\Product::inRandomOrder()->first()->id;
        }

        return [
            "customer_id" => $customerId,
            "product_id" => $productId,
            "price" => fake()->randomFloat(7, 10, 10000),
        ];
    }
}
