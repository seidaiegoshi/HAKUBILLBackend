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
        Schema::create('delivery_slips', function (Blueprint $table) {
            $table->id();
            $table->foreignId("customer_id")->constrained();
            $table->date("publish_date");
            $table->string("customer_name");
            $table->string("customer_post_code");
            $table->string("customer_address");
            $table->decimal("total_price");
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
        Schema::dropIfExists('delivery_slips');
    }
};
