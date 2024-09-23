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
        Schema::create('variations', function (Blueprint $table) {
            $table->increments('variation_id');
            $table->unsignedInteger('variation_category_id');
            $table->string('variation_name');
            $table->string('slug');
            $table->tinyInteger('status')->comment('1 is active variation and 0 is inactive variation');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('delete_user')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['variation_category_id','variation_id']);
            $table->foreign('variation_category_id')->references('variation_category_id')->on('variation_categories');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('delete_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variations');
    }
};
