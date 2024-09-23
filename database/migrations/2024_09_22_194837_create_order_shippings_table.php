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
        Schema::create('order_shippings', function (Blueprint $table) {
            $table->id();
            $table->string('order_id', 20);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mobile', 11);
            $table->string('email', 100);
            $table->string('address');
            $table->unsignedInteger('shipping_area_id')->nullable();
            $table->integer('post_code')->nullable();

            $table->foreign('shipping_areas')->references('id')->on('districts');
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
        Schema::dropIfExists('order_shippings');
    }
};
