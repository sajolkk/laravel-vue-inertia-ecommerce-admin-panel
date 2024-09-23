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
        Schema::create('purchase_masters', function (Blueprint $table) {
            $table->id();
            $table->string('lot_no', 20)->unique();
            $table->unsignedInteger('supplier_id');
            $table->string('invoice_no');
            $table->date('invoice_date');
            $table->float('total_amount', 11, 2);
            $table->float('discount', 11, 2)->nullable()->default(0);
            $table->float('grand_amount', 11, 2);
            $table->float('paid_amount', 11, 2)->nullable()->default(0);
            $table->float('due_amount', 11, 2)->nullable()->default(0);
            $table->tinyInteger('status')->comment('1 is lock and 0 is unlock');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('approve_by')->nullable();
            $table->timestamp('approve_time')->nullable();
            $table->unsignedInteger('delete_user')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('delete_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_masters');
    }
};
