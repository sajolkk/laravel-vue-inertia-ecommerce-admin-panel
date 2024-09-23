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
        Schema::create('offer_edit_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('edit_id');
            $table->unsignedInteger('offer_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('free_product_id');
            $table->float('discount', 11, 2);
            $table->timestamps();

            $table->index(['edit_id','offer_id','product_id']);
            $table->index(['offer_id','product_id']);
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->foreign('free_product_id')->references('product_id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_edit_products');
    }
};
