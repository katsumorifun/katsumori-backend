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
        Schema::create('anime_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('anime_id');
            $table->enum('status', ['watching', 'completed', 'hold', 'dropped', 'planned']);

            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->foreign('anime_id')->on('anime')->references('id')->onDelete('cascade');
            $table->primary(['user_id', 'anime_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anime_user');
    }
};
