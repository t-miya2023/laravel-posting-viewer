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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name');
            $table->text('shop_desc');
            $table->string('post_code', 7);
            $table->string('prefecture');
            $table->string('address');
            $table->string('tel', 20);
            $table->string('shop_email')->nullable();
            $table->string('business_hours')->nullable();
            $table->string('holidays')->nullable();
            $table->string('shop_img')->nullable();
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
        Schema::dropIfExists('shops');
    }
};
