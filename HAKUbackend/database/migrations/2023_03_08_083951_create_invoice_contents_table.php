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
        Schema::create('invoice_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId("invoice_id")->constrained();
            $table->foreignId("product_id")->constrained();
            $table->decimal("quantity", 8, 1);
            $table->decimal("price");
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
        Schema::dropIfExists('invoice_contents');
    }
};
