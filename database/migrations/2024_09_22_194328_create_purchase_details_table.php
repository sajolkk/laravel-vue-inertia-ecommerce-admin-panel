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
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->string('lot_no',20);
            $table->unsignedBigInteger('product_id');
            $table->integer('qty');
            $table->integer('return_qty')->default(0)->nullable();
            $table->float('unit_price', 11, 2);
            $table->float('discount', 11, 2)->default(0);
            $table->float('total_price', 11, 2)->comment('without discount');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('lot_no')->references('lot_no')->on('purchase_masters');
            $table->foreign('product_id')->references('product_id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_details');
    }
};
