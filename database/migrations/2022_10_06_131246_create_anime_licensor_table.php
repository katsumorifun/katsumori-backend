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
        Schema::create('anime_licensor', function (Blueprint $table) {
            $table->unsignedBigInteger('anime_id')->nullable(false);
            $table->unsignedBigInteger('licensor_id')->nullable(false);

            $table->foreign('anime_id')->on('anime')->references('id')->onDelete('cascade');
            $table->foreign('licensor_id')->on('licensors')->references('id')->onDelete('cascade');

            $table->primary(['anime_id', 'licensor_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anime_licensor');
    }
};
