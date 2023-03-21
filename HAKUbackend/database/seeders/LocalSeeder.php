<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\CustomerPrice;
use App\Models\DeliveryContent;
use App\Models\DeliverySlip;
use App\Models\FixedCost;
use App\Models\Invoice;
use App\Models\InvoiceContent;
use App\Models\Product;
use App\Models\ProductCategory;;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ProductCategory::factory()->count(4)->create();

        //各カテゴリ5商品ずつ登録
        foreach ($categories as $category) {
            Product::factory()
                ->count(5)
                ->create([
                    'product_category_id' => $category->id,
                ]);
        }

        Customer::factory()->count(10)->create();
        CustomerPrice::factory()->count(10)->create();
        DeliverySlip::factory()->count(120)->create();
        DeliveryContent::factory()->count(300)->create();
        Invoice::factory()->count(10)->create();
        InvoiceContent::factory()->count(10)->create();
        FixedCost::factory()->count(10)->create();
    }
}
