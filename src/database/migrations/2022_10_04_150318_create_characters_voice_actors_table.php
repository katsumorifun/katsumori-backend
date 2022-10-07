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
        Schema::create('characters_voice_actors', function (Blueprint $table){
            $table->unsignedBigInteger('character_id')->nullable(false);
            $table->unsignedBigInteger('staff_id')->nullable(false);

            $table->foreign('character_id')->on('characters')->references('id')->onDelete('cascade');
            $table->foreign('staff_id')->on('staff')->references('id')->onDelete('cascade');

            $table->primary(['character_id', 'staff_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
