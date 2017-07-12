<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMobileAppTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('mobile_app_artworks', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->integer('artwork_citi_id')->unsigned()->index();
            $table->foreign('artwork_citi_id')->references('citi_id')->on('artworks')->onDelete('cascade');
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->boolean('highlighted')->nullable();
            $table->integer('selector_number');
            $table = $this->_addDates($table);
        });

        Schema::create('mobile_app_sounds', function(Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->string('link');
            $table->text('transcript')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('artwork_mobile_app_sound', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->unsigned()->index();
            $table->foreign('artwork_citi_id')->references('citi_id')->on('artworks')->onDelete('cascade');
            $table->integer('mobile_app_sound_mobile_id')->unsigned()->index();
            $table->foreign('mobile_app_sound_mobile_id')->references('mobile_id')->on('mobile_app_sounds')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('tours', function(Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->text('intro_text')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('intro_mobile_id')->unsigned()->index();
            $table->foreign('intro_mobile_id')->references('mobile_id')->on('mobile_app_sounds')->onDelete('cascade');
            $table = $this->_addDates($table);
        });

        Schema::create('tour_stops', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('tour_mobile_id')->unsigned()->index();
            $table->foreign('tour_mobile_id')->references('mobile_id')->on('tours')->onDelete('cascade');
            $table->integer('artwork_citi_id')->unsigned()->index();
            $table->foreign('artwork_citi_id')->references('citi_id')->on('artworks')->onDelete('cascade');
            $table->integer('sound_mobile_id')->unsigned()->index();
            $table->foreign('sound_mobile_id')->references('mobile_id')->on('mobile_app_sounds')->onDelete('cascade');
            $table->integer('weight')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

    }

    private function _addIdsAndTitle($table)
    {

        $table->integer('mobile_id')->unsigned()->unique()->primary();
        $table->string('title');
        return $table;
    }

    private function _addDates($table, $citiField = true)
    {
        $table->timestamp('source_created_at')->nullable()->useCurrent();
        $table->timestamp('source_modified_at')->nullable()->useCurrent();
        $table->timestamps();
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
        Schema::dropIfExists('artwork_mobile_app_sound');
        Schema::dropIfExists('mobile_app_sounds');
        Schema::dropIfExists('mobile_app_artworks');
    }
}
