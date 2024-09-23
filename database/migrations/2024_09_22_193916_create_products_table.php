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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('product_id')->unique();
            $table->unsignedBigInteger('barcode')->nullable();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('brand_id')->nullable();
            $table->string('product_name');
            $table->string('slug');
            $table->string('product_model');
            $table->longText('description')->nullable();
            $table->longText('specification')->nullable();
            $table->string('product_unit');
            $table->string('variation_type')->nullable()->comment('There are 3 types variation. The variation are null,color,size,color&size');
            $table->enum('product_type', ['General', 'Budget PC'])->default('General')->nullable();
            $table->float('original_price', 11, 2)->default(0)->nullable();
            $table->float('sale_price', 11, 2)->default(0)->nullable();
            $table->float('regular_price', 11, 2)->default(0)->nullable();
            $table->float('discount', 11, 2)->default(0)->nullable();
            $table->integer('warranty')->default(0)->nullable();
            $table->string('word_warranty')->nullable();
            $table->tinyInteger('status')->comment('1=public,this means user see this product. 0=private, this means user can not see this product');
            $table->tinyInteger('stock_status')->comment('1 is stock available,2 is stock out and 3 is upcomming');
            $table->tinyInteger('feature_pro_status')->comment('1 is feature product is active and 0 is feature product is not active');
            $table->tinyInteger('hot_product')->comment('1 is hot product is active and 0 is hot product is not active');
            $table->string('thumbnail')->nullable();
            $table->text('key_features')->nullable();
            $table->float('per_month_emi')->nullable()->default(0);
            $table->float('emi_interest_rate')->nullable()->default(0)->comments('emi interest rate percantage %');
            $table->float('total_emi')->nullable()->default(0);
            $table->float('total_month')->nullable()->default(0)->comments('total emi months');
            $table->integer('stock_qty')->default(0)->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('delete_user')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('brand_id')->references('brand_id')->on('brands');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('delete_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
