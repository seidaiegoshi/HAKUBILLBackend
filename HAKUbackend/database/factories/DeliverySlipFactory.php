<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliverySlip>
 */
class DeliverySlipFactory extends Factory
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
            "publish_date" => fake()->dateTimeBetween($startDate = '-60 days', $endDate = 'now'),

        ];
    }
}
