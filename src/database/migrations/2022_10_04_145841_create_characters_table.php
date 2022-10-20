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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->integer('mal_id')->nullable();
            $table->string('name_jp');
            $table->string('name_en')->nullable();
            $table->string('name_ru')->nullable();
            $table->string('image_x32')->default('x32/default.png');
            $table->string('image_x64')->default('x64/default.png');
            $table->string('image_original')->default('x32/original.png');
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('characters');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
