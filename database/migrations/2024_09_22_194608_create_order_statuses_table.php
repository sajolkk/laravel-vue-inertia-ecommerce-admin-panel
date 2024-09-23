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
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->primary(['order_id']);
            $table->string('order_id',20);
            $table->tinyInteger('payment_status')->default(0);
            $table->tinyInteger('processing_status')->default(0);
            $table->tinyInteger('picked_status')->default(0);
            $table->tinyInteger('shipped_status')->default(0);
            $table->tinyInteger('delivered_status')->default(0);
            $table->tinyInteger('confirm_status')->default(0);
            $table->timestamp('payment_time')->nullable();
            $table->timestamp('processing_time')->nullable();
            $table->timestamp('picked_time')->nullable();
            $table->timestamp('shipped_time')->nullable();
            $table->timestamp('delivered_time')->nullable();
            $table->timestamp('confirm_time')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('order_id')->on('order_masters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_statuses');
    }
};
