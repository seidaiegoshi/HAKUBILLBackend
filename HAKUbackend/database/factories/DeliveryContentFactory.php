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
        $product_id = \App\Models\Product::all()->random(1)[0]->id;
        $total_cost = \App\Models\Product::find($product_id)->total_cost;
        $quantity = fake()->randomFloat(7, 1, 50);
        $price = \App\Models\Product::find($product_id)->price;
        $gross_profit = $price - $total_cost;
        $subtotal = $quantity * $price;
        $subtotal_gross_profit = $gross_profit * $quantity;

        return [
            "delivery_slip_id" => \App\Models\DeliverySlip::all()->random(1)[0]->id,
            "product_id" => $product_id,
            "product_name" => \App\Models\Product::find($product_id)->name,
            "unit" => \App\Models\Product::find($product_id)->unit,
            "price" => $price,
            "total_cost" => $total_cost,
            "quantity" => $quantity,
            "gross_profit" => $gross_profit,
            "subtotal" => $subtotal,
            "subtotal_gross_profit" => $subtotal_gross_profit,
        ];
    }
}
