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
        Schema::create('order_product_serials', function (Blueprint $table) {
            $table->id();
            $table->string('order_id',20);
            $table->string('lot_no',20);
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('variation_id')->nullable();
            $table->unsignedBigInteger('serial_id');
            $table->string('product_serial');
            $table->integer('qty');
            $table->integer('return_qty')->default(0)->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('order_id')->on('order_masters');
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->foreign('variation_id')->references('variation_id')->on('product_variations');
            $table->foreign('serial_id')->references('id')->on('product_serials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product_serials');
    }
};
