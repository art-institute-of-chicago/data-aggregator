<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeArtworkDateQualifierPointerToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('artwork_dates', function(Blueprint $table) {
            $table->dropColumn('qualifier');
        });
        Schema::table('artwork_dates', function(Blueprint $table) {
            $table->integer('artwork_date_qualifier_citi_id')->nullable()->after('date_latest');
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
            $table->dropColumn('artwork_date_qualifier_citi_id');
        });
        Schema::table('artwork_dates', function(Blueprint $table) {
            $table->string('qualifier')->nullable()->after('date_latest');
        });

    }
}
