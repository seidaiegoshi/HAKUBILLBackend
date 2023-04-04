<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\CustomerPrice;
use App\Models\DeliveryContent;
use App\Models\DeliverySlip;
use App\Models\FixedCost;
use App\Models\Invoice;
use App\Models\InvoiceContent;
use App\Models\MaterialProduct;
use App\Models\Product;
use App\Models\ProductCategory;;

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

        // どうやらseederは並列処理するので、1回1回まわさないと、ユニークキーの重複担ってしまう模様。100個データ作る。
        for ($i = 0; $i < 100; $i++) {
            CustomerPrice::factory()->count(1)->create();
        }
        for ($i = 0; $i < 50; $i++) {
            $recipe = MaterialProduct::factory()->count(1)->create()->first();
            $product = Product::find($recipe->product_id);
            $product->is_product = true;
            $product->save();
        }

        DeliverySlip::factory()->count(300)->create();
        DeliveryContent::factory()->count(300)->create();
        Invoice::factory()->count(10)->create();
        InvoiceContent::factory()->count(10)->create();
        FixedCost::factory()->count(10)->create();
    }
}
