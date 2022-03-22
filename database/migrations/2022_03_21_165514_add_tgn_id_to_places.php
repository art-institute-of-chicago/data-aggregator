<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTgnIdToPlaces extends Migration
{
    public function up()
    {
        Schema::table('places', function (Blueprint $table) {
            $table->integer('tgn_id')->signed()->nullable()->after('title');
        });
    }

    public function down()
    {
        Schema::table('places', function (Blueprint $table) {
            $table->dropColumn('tgn_id');
        });
    }
}
