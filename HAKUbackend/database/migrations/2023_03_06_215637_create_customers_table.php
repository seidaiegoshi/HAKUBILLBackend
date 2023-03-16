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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string("name")->comment("取引先名");
            $table->string("honorific")->comment("敬称");
            $table->string("post")->nullable()->comment("部署名");
            $table->char("post_code", 7)->nullable()->comment("郵便番号");
            $table->string("address")->nullable()->comment("住所");
            $table->char("telephone_number", 14)->nullable()->comment("電話番号");
            $table->char("fax_number", 14)->nullable()->comment("FAX番号");
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
        Schema::dropIfExists('customers');
    }
};
