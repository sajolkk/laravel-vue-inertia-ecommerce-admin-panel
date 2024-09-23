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
        Schema::create('offer_edits', function (Blueprint $table) {
            $table->increments('edit_id');
            $table->unsignedInteger('offer_id');
            $table->string('title');
            $table->string('slug');
            $table->timestamp('start_from');
            $table->timestamp('end_to');
            $table->text('conditions');
            $table->string('offer_type',10);
            $table->text('offer_details');
            $table->string('image');
            $table->string('promo_code',20);
            $table->float('min_amount',11,2);
            $table->float('total_discount',11,2);
            $table->tinyInteger('status')->default(0)->comment('1 is active offer and 0 is inactive offer');
            $table->tinyInteger('slider_status')->default(0)->comment('1 is active slider and 0 is inactive slider');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('edit_user');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('edit_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_edits');
    }
};
