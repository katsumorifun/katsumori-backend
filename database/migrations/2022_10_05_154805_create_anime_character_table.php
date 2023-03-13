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
        Schema::create('anime_character', function (Blueprint $table) {
            $table->unsignedBigInteger('anime_id')->nullable(false);
            $table->unsignedBigInteger('character_id')->nullable(false);

            $table->foreign('anime_id')->on('anime')->references('id')->onDelete('cascade');
            $table->foreign('character_id')->on('characters')->references('id')->onDelete('cascade');
            $table->primary(['anime_id', 'character_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anime_character');
    }
};
