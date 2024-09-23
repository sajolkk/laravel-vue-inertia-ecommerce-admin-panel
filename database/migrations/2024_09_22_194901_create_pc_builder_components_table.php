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
        Schema::create('pc_builder_componets', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('category_id');
            $table->boolean('required')->default(1)->comment('1 is required');
            $table->integer('min_qty');
            $table->integer('max_qty')->nullable();
            $table->integer('order');
            $table->enum('component_type', ['Core Components', 'Peripherals & Others']);
            $table->boolean('status')->default(1)->comment('1 is active and 0 is inactive');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('delete_user')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pc_builder_componets');
    }
};
