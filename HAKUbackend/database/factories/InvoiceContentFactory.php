<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvoiceContent>
 */
class InvoiceContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "invoice_id" => \App\Models\Invoice::all()->random(1)[0]->id,
            "product_id" => \App\Models\Product::all()->random(1)[0]->id,
            "quantity" => fake()->randomFloat(7, 1, 50),
        ];
    }
}
