<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtworkPlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('artwork_place', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('artwork_citi_id')->signed()->index();
            $table->integer('place_citi_id')->signed()->index();
            $table->integer('artwork_place_qualifier_citi_id')->signed()->index();
            $table->boolean('preferred')->index();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('artwork_place');

    }
}
