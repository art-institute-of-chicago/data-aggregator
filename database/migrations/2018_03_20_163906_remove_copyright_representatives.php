<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveCopyrightRepresentatives extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('artwork_copyright_representative');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::create('artwork_copyright_representative', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->signed()->index();
            $table->integer('agent_citi_id')->signed()->index();
        });

    }
}
