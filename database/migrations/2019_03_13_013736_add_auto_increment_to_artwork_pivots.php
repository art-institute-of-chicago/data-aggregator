<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Facades\DB;

class AddAutoIncrementToArtworkPivots extends Migration
{
    public function up()
    {
        Schema::table('artwork_catalogue', function (Blueprint $table) {
            $table->dropColumn('citi_id');
        });

        Schema::table('artwork_catalogue', function (Blueprint $table) {
            $table->increments('id')->first();
        });

        Schema::table('artwork_dates', function (Blueprint $table) {
            $table->dropColumn('citi_id');
        });

        Schema::table('artwork_dates', function (Blueprint $table) {
            $table->increments('id')->first();
        });
    }

    public function down()
    {
        // the `citi_id` change is irreversible
        DB::table('artwork_catalogue')->truncate();
        DB::table('artwork_dates')->truncate();

        Schema::table('artwork_catalogue', function (Blueprint $table) {
            $table->dropColumn('id');
        });

        Schema::table('artwork_catalogue', function (Blueprint $table) {
            $table->integer('citi_id')->primary()->first();
        });

        Schema::table('artwork_dates', function (Blueprint $table) {
            $table->dropColumn('id');
        });

        Schema::table('artwork_dates', function (Blueprint $table) {
            $table->integer('citi_id')->primary()->first();
        });
    }
}
