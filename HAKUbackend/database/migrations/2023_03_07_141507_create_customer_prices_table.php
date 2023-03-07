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
        Schema::create('customer_prices', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("customer_id")
                ->constrained()
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table
                ->foreignId("product_id")
                ->constrained()
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table->decimal("price", 8, 1);
            $table->timestamps();
            $table->unique(["customer_id", "product_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_prices');
    }
};
