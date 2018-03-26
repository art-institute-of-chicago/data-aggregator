<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameMediumOnArtworks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('artworks', function (Blueprint $table) {
            $table->renameColumn('medium', 'medium_display');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('artworks', function (Blueprint $table) {
            $table->renameColumn('medium_display', 'medium');
        });

    }
}
