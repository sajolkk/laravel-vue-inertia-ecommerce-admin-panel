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
        Schema::create('pc_builder_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pc_builder_id')->references('id')->on('pc_builders');
            $table->foreignId('pc_builder_component_id')->references('id')->on('pc_builder_componets');
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('variation_id')->nullable();
            $table->unsignedBigInteger('qty');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_id')->references('product_id')->on('products');
            $table->foreign('variation_id')->references('variation_id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pc_builder_products');
    }
};
