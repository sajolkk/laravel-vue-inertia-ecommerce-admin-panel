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
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('variation_id')->nullable()->comment('variation id');
            $table->float('original_price', 11, 2)->default(0)->nullable();
            $table->float('sale_price', 11, 2)->default(0)->nullable();
            $table->float('regular_price', 11, 2)->default(0)->nullable();
            $table->float('discount', 11, 2)->default(0)->nullable();
            $table->tinyInteger('status')->comment('1 is active and 0 is inactive');
            $table->integer('stock_qty')->default(0)->nullable(); 
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('delete_user')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_id')->references('product_id')->on('products');
            $table->foreign('variation_id')->references('variation_id')->on('variations');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('delete_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variations');
    }
};
