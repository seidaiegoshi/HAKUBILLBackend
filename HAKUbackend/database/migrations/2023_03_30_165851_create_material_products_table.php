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
        Schema::create('material_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->comment("完成するもの");
            $table->unsignedBigInteger('material_id')->comment("材料になる商品ID");
            $table->decimal("yield_rate", 5, 4)->comment("材料の加工に発生する歩留まりや不良率");
            $table->decimal("usage_rate", 5, 4)->comment("材料の使用率");;
            $table->timestamps();

            $table->unique(['material_id', 'product_id']);

            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('material_id')
                ->references('id')->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_products');
    }
};
