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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('customer_id');
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('mobile', 11)->nullable();
            $table->string('address')->nullable();
            $table->integer('post_code')->nullable();
            $table->unsignedInteger('shipping_area_id')->nullable();
            $table->string('password')->nullable();
            $table->unsignedInteger('otp')->nullable();
            $table->string('token')->nullable();
            $table->timestamp('verify_at')->nullable()->comment('verified time');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
