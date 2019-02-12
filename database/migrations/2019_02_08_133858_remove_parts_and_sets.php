<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemovePartsAndSets extends Migration
{
    public function up()
    {
        Schema::dropIfExists('artwork_artwork');
    }

    public function down()
    {
        Schema::create('artwork_artwork', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('set_citi_id')->index();
            $table->integer('part_citi_id')->index();
        });
    }
}
