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
        Schema::create('anime_staff', function (Blueprint $table) {
            $table->unsignedBigInteger('anime_id')->nullable(false);
            $table->unsignedBigInteger('staff_id')->nullable(false);
            $table->enum('position', [
                'original creator',
                'producer',
                'director',
                'sound director',
                'script',
                'series composition',
                'theme song performance',
                'theme song lyrics',
                'theme song arrangement',
                'theme song сomposition',
                'color design',
                'background art',
                'key animation',
                'director of photography',
                'chief animation director',
                'character design',
                'editing'
            ]);

            $table->foreign('anime_id')->on('anime')->references('id')->onDelete('cascade');
            $table->foreign('staff_id')->on('staff')->references('id')->onDelete('cascade');

            $table->primary(['anime_id', 'staff_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anime_staff');
    }
};
