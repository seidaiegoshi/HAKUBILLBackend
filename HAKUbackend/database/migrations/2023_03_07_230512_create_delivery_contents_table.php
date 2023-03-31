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
        Schema::create('delivery_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId("delivery_slip_id")->constrained();
            $table->foreignId("product_id")->constrained();
            $table->string("product_name");
            $table->string("unit");
            $table->decimal("price", 8, 2);
            $table->decimal("total_cost", 8, 2);
            $table->decimal("quantity", 8, 2);
            $table->decimal("gross_profit", 8, 2);
            $table->decimal("subtotal", 8, 2);
            $table->decimal("subtotal_gross_profit", 8, 2);
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
        Schema::dropIfExists('delivery_contents');
    }
};
