<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $address = fake()->prefecture() . fake()->city() . fake()->streetAddress();
        return [
            "name" => fake()->company(),
            "honorific" => fake()->randomElement(["様", "御中"]),
            "post_code" => fake()->postcode(),
            "address" => $address,
            "telephone_number" => fake()->phoneNumber(),
            "fax_number" => fake()->phoneNumber(),
        ];
    }
}
