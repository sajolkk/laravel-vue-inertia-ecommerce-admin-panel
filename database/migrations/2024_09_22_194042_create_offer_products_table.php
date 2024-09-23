<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('offer_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('offer_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('free_product_id')->nullable();
            $table->float('discount', 11,2)->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['offer_id','product_id']);
            $table->foreign('offer_id')->references('offer_id')->on('offers');
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->foreign('free_product_id')->references('product_id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_products');
    }
};
