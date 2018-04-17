<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateArtworkDateFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('artwork_dates', function(Blueprint $table) {
            $table->dropColumn('date');
        });

        Schema::table('artwork_dates', function(Blueprint $table) {
            $table->date('date_earliest')->nullable()->after('artwork_citi_id');
            $table->date('date_latest')->nullable()->after('date_earliest');
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
            $table->dropColumn('date_earliest');
            $table->dropColumn('date_latest');
        });

        Schema::table('artwork_dates', function(Blueprint $table) {
            $table->date('date')->nullable()->after('artwork_citi_id');
        });

    }
}
