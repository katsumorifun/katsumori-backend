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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('mal_id')->nullable();
            $table->string('name_jp');
            $table->string('name_en')->nullable();
            $table->string('name_ru')->nullable();
            $table->string('image_x32')->default('/x32/default.png');
            $table->string('image_x64')->default('/x64/default.png');;
            $table->string('image_original')->default('/original/default.png');;
            $table->boolean('is_voice_actor')->default(false);
            $table->enum('voice_language', ["english", "russian", "french", "japanese"])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
};
