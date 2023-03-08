<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\CustomerPrice;
use App\Models\DeliveryContent;
use App\Models\DeliverySlip;
use App\Models\Invoice;
use App\Models\InvoiceContent;
use App\Models\Product;;

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
        Product::factory()->count(10)->create();
        Customer::factory()->count(10)->create();
        CustomerPrice::factory()->count(10)->create();
        DeliverySlip::factory()->count(10)->create();
        DeliveryContent::factory()->count(10)->create();
        Invoice::factory()->count(10)->create();
        InvoiceContent::factory()->count(10)->create();
    }
}
