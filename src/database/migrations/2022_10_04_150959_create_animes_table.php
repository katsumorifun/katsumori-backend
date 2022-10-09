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
        Schema::create('anime', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('mal_id')->nullable();
            $table->float('mal_score')->nullable();
            $table->string('title_jp');
            $table->string('title_en')->nullable();
            $table->string('title_ru')->nullable();
            $table->string('synopsis_en')->nullable();
            $table->text('synopsis_ru')->nullable();
            $table->enum('type', ['serial',  'film', 'ova', 'ona', 'clip', 'special', 'tv'])->nullable();
            $table->boolean('approved')->nullable(false)->default(false);
            $table->enum('status', ['announced', 'ongoing', 'finished'])->nullable();
            $table->string('image_x32')->default('/x32/default.png');
            $table->string('image_x64')->default('/x64/default.png');
            $table->string('image_x128')->default('/x128/default.png');
            $table->string('image_original')->default('/original/default.png');
            $table->json('title_synonyms')->nullable(); // {"type": "Japanese", "title": "title"}
            $table->enum('source', ['manga', 'light novel', 'original'])->nullable();
            $table->integer('episodes')->nullable();
            $table->integer('episodes_aired')->nullable();
            $table->dateTime('episodes_from')->nullable()->default(null);
            $table->dateTime('episodes_to')->nullable()->default(null);;
            $table->integer('duration')->default(0);
            $table->enum('age_rating', ['g', 'pg', 'pg-13', 'r-17', 'r+'])->nullable();
            $table->enum('season', ['summer', 'autumn', 'winter', 'spring'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animes');
    }
};
