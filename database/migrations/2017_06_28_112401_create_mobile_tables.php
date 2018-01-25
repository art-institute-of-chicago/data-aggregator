<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMobileTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $this->down();

        Schema::create('mobile_artworks', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->integer('artwork_citi_id')->unsigned()->nullable()->index();

            // Disabling foreign key checks in order to decouple mobile import from collections import
            // $table->foreign('artwork_citi_id')->references('citi_id')->on('artworks')->onDelete('cascade');

            // https://laracasts.com/discuss/channels/laravel/schema-float-function-generated-a-double-type
            $table->double('latitude', 15, 13)->nullable();
            $table->double('longitude', 16, 13)->nullable();

            $table->boolean('highlighted')->nullable();
            $table->integer('selector_number')->nullable();
            $table->timestamps();
        });

        Schema::create('mobile_sounds', function(Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->string('link');
            $table->text('transcript')->nullable();
            $table->timestamps();
        });

        Schema::create('mobile_artwork_mobile_sound', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('mobile_artwork_mobile_id')->unsigned()->index();
            $table->foreign('mobile_artwork_mobile_id')->references('mobile_id')->on('mobile_artworks')->onDelete('cascade');
            $table->integer('mobile_sound_mobile_id')->unsigned()->index();
            $table->foreign('mobile_sound_mobile_id')->references('mobile_id')->on('mobile_sounds')->onDelete('cascade');
        });

        Schema::create('tours', function(Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->text('intro_text')->nullable();
            $table->integer('intro_mobile_id')->unsigned()->index();
            $table->foreign('intro_mobile_id')->references('mobile_id')->on('mobile_sounds')->onDelete('cascade');
            $table->integer('weight')->nullable();
            $table->timestamps();
        });

        Schema::create('tour_stops', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('tour_mobile_id')->unsigned()->index();
            $table->foreign('tour_mobile_id')->references('mobile_id')->on('tours')->onDelete('cascade');
            $table->integer('mobile_artwork_mobile_id')->unsigned()->index();
            $table->foreign('mobile_artwork_mobile_id')->references('mobile_id')->on('mobile_artworks')->onDelete('cascade');
            $table->integer('mobile_sound_mobile_id')->unsigned()->index();
            $table->foreign('mobile_sound_mobile_id')->references('mobile_id')->on('mobile_sounds')->onDelete('cascade');
            $table->integer('weight')->unsigned()->nullable();
            // A TourStop's description is its Sound's transcription
            $table->timestamps();
        });

    }

    private function _addIdsAndTitle($table)
    {

        $table->integer('mobile_id')->unsigned()->unique()->primary();
        $table->string('title');
        return $table;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('tour_stops');
        Schema::dropIfExists('tours');
        Schema::dropIfExists('mobile_artwork_mobile_sound');
        Schema::dropIfExists('mobile_sounds');
        Schema::dropIfExists('mobile_artworks');

    }

}
