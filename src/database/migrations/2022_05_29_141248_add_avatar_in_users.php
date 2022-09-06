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
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable(false)->default('default.png');
            $table->string('avatar_x32')->nullable(false)->default('/x32/default.png');
            $table->string('avatar_x64')->nullable(false)->default('/x64/default.png');
            $table->string('avatar_x128')->nullable(false)->default('/x128/default.png');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('avatar');
            $table->dropColumn('avatar_x32');
            $table->dropColumn('avatar_x64');
            $table->dropColumn('avatar_x128');
        });
    }
};
