<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StopIncrementingTourStopIds extends Migration
{
    public function up()
    {
        Schema::table('tour_stops', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->change();
        });
    }

    public function down()
    {
        Schema::table('tour_stops', function (Blueprint $table) {
            $table->integer('id')->unsigned()->autoIncrement()->change();
        });
    }
}
