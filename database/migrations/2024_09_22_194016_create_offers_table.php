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
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('offer_id');
            $table->string('title');
            $table->string('slug');
            $table->timestamp('start_from')->nullable();
            $table->timestamp('end_to')->nullable();
            $table->text('conditions');
            $table->string('offer_type', 10);
            $table->text('offer_details');
            $table->string('image');
            $table->string('promo_code', 20)->nullable();
            $table->float('min_amount', 11, 2)->nullable();
            $table->float('total_discount', 11, 2)->nullable();
            $table->tinyInteger('status')->default(0)->comment('1 is active offer and 0 is inactive offer');
            $table->tinyInteger('slider_status')->default(0)->comment('1 is active slider and 0 is inactive slider');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('delete_user')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('delete_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
