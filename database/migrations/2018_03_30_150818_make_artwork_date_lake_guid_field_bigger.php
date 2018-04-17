<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeArtworkDateLakeGuidFieldBigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('artwork_dates', function(Blueprint $table) {
            $table->string('lake_guid')->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('artwork_dates', function(Blueprint $table) {
            $table->uuid('lake_guid')->change();
        });

    }
}
