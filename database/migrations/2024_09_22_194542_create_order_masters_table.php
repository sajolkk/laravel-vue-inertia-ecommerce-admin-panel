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
        Schema::create('order_masters', function (Blueprint $table) {
            $table->id();
            $table->string('order_id', 20)->unique();
            $table->unsignedBigInteger('customer_id');
            $table->float('sub_total', 11, 2);
            $table->float('discount', 11, 2)->default(0);
            $table->float('net_amount', 11, 2);
            $table->float('shipping_fee', 11, 2);
            $table->string('payment_type', 20);
            $table->string('note')->nullable();
            $table->unsignedInteger('invoice_by')->nullable();
            $table->unsignedInteger('delivery_user')->nullable();
            $table->string('delivery_method', 30);
            $table->unsignedBigInteger('offer_id')->nullable();
            $table->float('total_emi_amount')->nullable()->default(0)->comments('total emi amount');
            $table->float('per_month_emi')->nullable()->default(0)->comments('per month emi amount');
            $table->float('paid_emi_amount')->nullable()->default(0)->comments('total emi amount');
            // $table->integer('post_code')->nullable();
            $table->string('status', 20)->comment('order process status');
            $table->string('cancel_note')->nullable();
            $table->unsignedInteger('cancel_by')->nullable()->comment('cancel by shop employee id');
            $table->timestamp('cancel_time')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('customer_id')->on('customers');
            $table->foreign('invoice_by')->references('id')->on('users');
            $table->foreign('delivery_user')->references('id')->on('users');
            $table->foreign('cancel_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_masters');
    }
};
