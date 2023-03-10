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
            $table->string("name")->comment("商品名");
            $table->decimal("cost", 8, 1)->comment("原価(変動費)");
            $table->string("unit")->comment("単位");
            $table->integer("tax_class")->comment("税区分");
            $table->decimal("price", 8, 1,)->comment("販売価格(デフォルト)");
            $table->timestamps();
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
