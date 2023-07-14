<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_artworks', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->integer('artwork_citi_id')->nullable()->index();

            // https://laracasts.com/discuss/channels/laravel/schema-float-function-generated-a-double-type
            $table->double('latitude', 16, 13)->nullable();
            $table->double('longitude', 16, 13)->nullable();

            $table->timestamps();
        });

        Schema::create('mobile_sounds', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->string('web_url');
            $table->text('transcript')->nullable();
            $table->timestamps();
        });

        Schema::create('mobile_artwork_mobile_sound', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mobile_artwork_mobile_id')->unsigned()->index();
            $table->integer('mobile_sound_mobile_id')->unsigned()->index();
        });

        Schema::create('tours', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table, 'string');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->text('intro_text')->nullable();
            $table->integer('intro_mobile_id')->unsigned()->index();
            $table->integer('weight')->nullable();
            $table->timestamps();
        });

        Schema::create('tour_stops', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->primary();
            $table->integer('tour_mobile_id')->unsigned()->index();
            $table->integer('mobile_artwork_mobile_id')->unsigned()->index();
            $table->integer('mobile_sound_mobile_id')->unsigned()->index();
            $table->integer('weight')->unsigned()->nullable();
            // A TourStop's description is its Sound's transcription
            $table->timestamps();
        });
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

    private function _addIdsAndTitle($table, $titleType = 'text')
    {
        $table->integer('mobile_id')->unsigned()->primary();
        $table->{$titleType}('title');
        return $table;
    }
};
