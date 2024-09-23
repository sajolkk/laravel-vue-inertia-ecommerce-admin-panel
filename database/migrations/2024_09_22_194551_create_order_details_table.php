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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->string('order_id', 20);
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('variation_id')->nullable();
            $table->integer('qty');
            $table->integer('return_qty')->nullable()->default(0);
            $table->float('discount', 11, 2)->nullable()->default(0);
            $table->float('sale_price', 11, 2);
            $table->float('total_amount', 11, 2);
            $table->float('emi_sale_price')->nullable()->default(0);
            $table->float('total_emi_amount')->nullable()->default(0)->comments('total emi amount');
            $table->float('total_month')->nullable()->default(0)->comments('total emi month');
            $table->integer('warranty')->nullable();
            $table->string('word_warranty')->nullable();
            $table->unsignedBigInteger('offer_id')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('order_id')->on('order_masters');
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->foreign('variation_id')->references('variation_id')->on('product_variations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};
