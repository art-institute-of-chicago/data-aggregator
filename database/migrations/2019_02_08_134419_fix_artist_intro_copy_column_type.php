<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixArtistIntroCopyColumnType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('web_artists', function (Blueprint $table) {
            $table->text('intro_copy')->nullable()->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('web_artists', function (Blueprint $table) {
            $table->timestamp('intro_copy')->nullable()->change();
        });

    }
}
