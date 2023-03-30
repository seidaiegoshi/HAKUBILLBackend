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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string("name")->comment("食材名");
            $table->string("unit")->comment("単位");
            $table->decimal("price", 8, 1,)->comment("価格");
            $table->decimal("yield", 8, 1,)->comment("歩留まり率");
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
        Schema::dropIfExists('materials');
    }
};
