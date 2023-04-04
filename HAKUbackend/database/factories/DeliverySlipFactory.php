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
        $customer = \App\Models\Customer::all()->random(1)[0];
        return [
            "customer_id" => $customer->id,
            "customer_name" => $customer->name,
            "customer_post_code" => $customer->post_code,
            "customer_address" => $customer->address,
            "publish_date" => fake()->dateTimeBetween($startDate = '-60 days', $endDate = 'now'),
            "total_price" => fake()->randomFloat(7, 1, 50),
        ];
    }
}
