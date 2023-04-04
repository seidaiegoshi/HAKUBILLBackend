<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_category_id")->constrained();
            $table->string("name")->comment("商品名");
            $table->decimal("price", 8, 1,)->comment("販売価格(デフォルト)");
            $table->decimal("total_cost", 8, 1)->nullable()->comment("原価(変動費)");
            $table->decimal("weight")->nullable()->comment("商品の重量(g)");;
            $table->decimal("cost_per_gram")->nullable()->comment("1gあたりの重さ");;
            $table->string("unit")->comment("単位");
            $table->decimal("gross_profit", 8, 1,)->comment("粗利");
            $table->decimal("gross_rate", 8, 1,)->comment("粗利率");
            $table->boolean("is_product");

            $table->softDeletes();
            $table->timestamps();

            $table->index("name");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
