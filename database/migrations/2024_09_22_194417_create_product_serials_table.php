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
        Schema::create('product_serials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lot_no',20);
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('variation_id')->nullable();
            $table->string('product_serial');
            $table->integer('qty');
            $table->integer('return_qty')->default(0)->nullable();
            $table->tinyInteger('status')->comment('1 is authorized product and 0 is unauthorized product');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('lot_no')->references('lot_no')->on('purchase_masters');
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->foreign('variation_id')->references('variation_id')->on('variations');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_serials');
    }
};
