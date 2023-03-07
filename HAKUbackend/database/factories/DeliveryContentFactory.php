<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryContent>
 */
class DeliveryContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "delivery_slip_id" => \App\Models\DeliverySlip::all()->random(1)[0]->id,
            "product_id" => \App\Models\Product::all()->random(1)[0]->id,
            "quantity" => fake()->randomFloat(7, 1, 50),
        ];
    }
}
