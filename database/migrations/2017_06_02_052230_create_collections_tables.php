<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('agent_types', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table = $this->_addDates($table);
        });

        Schema::create('artists', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->integer('date_birth')->nullable();
            $table->integer('date_death')->nullable();
            $table->integer('agent_type_citi_id')->nullable();
            $table->foreign('agent_type_citi_id')->references('citi_id')->on('agent_types');
            $table = $this->_addDates($table);
        });

        Schema::create('departments', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table = $this->_addDates($table);
        });

        Schema::create('categories', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->text('description')->nullable();
            $table->boolean('is_in_nav')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('sort')->nullable();
            $table->integer('type')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('artworks', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->string('main_id')->nullable();
            $table->string('date_display')->nullable();
            $table->integer('date_start')->nullable();
            $table->integer('date_end')->nullable();
            $table->integer('artist_citi_id')->nullable();
            $table->foreign('artist_citi_id')->references('citi_id')->on('artists');
            $table->string('artist_display')->nullable();
            $table->integer('department_citi_id')->nullable();
            $table->foreign('department_citi_id')->references('citi_id')->on('departments');
            $table->string('dimensions')->nullable();
            $table->string('medium')->nullable();
            $table->string('credit_line')->nullable();
            $table->string('inscriptions')->nullable();
            $table->text('publications')->nullable();
            $table->text('exhibitions')->nullable();
            $table->text('provenance')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('artwork_category', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id');
            $table->uuid('category_lake_guid');
            $table->foreign('artwork_citi_id')->references('citi_id')->on('artworks')->onDelete('cascade');
            $table->foreign('category_lake_guid')->references('lake_guid')->on('categories')->onDelete('cascade');
        });


        Schema::create('galleries', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->string('closed')->nullable();
            $table->string('number')->nullable();
            $table->integer('floor')->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('themes', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->text('description')->nullable();
            $table->string('is_in_navigation')->nullable();
            $table->string('sort')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('links', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table, false);
            $table->text('description')->nullable();
            $table->string('content')->nullable();
            $table->string('published')->nullable();
            $table->integer('artist_citi_id')->nullable();
            $table->foreign('artist_citi_id')->references('citi_id')->on('artists');
            $table = $this->_addDates($table);
        });

        Schema::create('category_link', function(Blueprint $table) {
            $table->increments('id');
            $table->uuid('link_lake_guid');
            $table->uuid('category_lake_guid');
            $table->foreign('link_lake_guid')->references('lake_guid')->on('links')->onDelete('cascade');
            $table->foreign('category_lake_guid')->references('lake_guid')->on('categories')->onDelete('cascade');
        });

        Schema::create('sounds', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table, false);
            $table->text('description')->nullable();
            $table->string('content')->nullable();
            $table->string('published')->nullable();
            $table->integer('artist_citi_id')->nullable();
            $table->foreign('artist_citi_id')->references('citi_id')->on('artists');
            $table = $this->_addDates($table);
        });

        Schema::create('category_sound', function(Blueprint $table) {
            $table->increments('id');
            $table->uuid('sound_lake_guid');
            $table->uuid('category_lake_guid');
            $table->foreign('sound_lake_guid')->references('lake_guid')->on('sounds')->onDelete('cascade');
            $table->foreign('category_lake_guid')->references('lake_guid')->on('categories')->onDelete('cascade');
        });

        Schema::create('videos', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table, false);
            $table->text('description')->nullable();
            $table->string('content')->nullable();
            $table->string('published')->nullable();
            $table->integer('artist_citi_id')->nullable();
            $table->foreign('artist_citi_id')->references('citi_id')->on('artists');
            $table = $this->_addDates($table);
        });

        Schema::create('category_video', function(Blueprint $table) {
            $table->increments('id');
            $table->uuid('video_lake_guid');
            $table->uuid('category_lake_guid');
            $table->foreign('video_lake_guid')->references('lake_guid')->on('videos')->onDelete('cascade');
            $table->foreign('category_lake_guid')->references('lake_guid')->on('categories')->onDelete('cascade');
        });

        Schema::create('texts', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table, false);
            $table->text('description')->nullable();
            $table->string('content')->nullable();
            $table->string('published')->nullable();
            $table->integer('artist_citi_id')->nullable();
            $table->foreign('artist_citi_id')->references('citi_id')->on('artists');
            $table = $this->_addDates($table);
        });

        Schema::create('category_text', function(Blueprint $table) {
            $table->increments('id');
            $table->uuid('text_lake_guid');
            $table->uuid('category_lake_guid');
            $table->foreign('text_lake_guid')->references('lake_guid')->on('texts')->onDelete('cascade');
            $table->foreign('category_lake_guid')->references('lake_guid')->on('categories')->onDelete('cascade');
        });




        Schema::create('images', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table, false);
            $table->text('description')->nullable();
            $table->string('imaging_uid')->nullable();
            $table->string('type')->nullable();
            $table->string('content')->nullable();
            $table->string('published')->nullable();
            $table->integer('artwork_citi_id')->nullable();
            $table->foreign('artwork_citi_id')->references('citi_id')->on('artworks');
            $table->string('iiif_url')->unique()->nullable();
            $table = $this->_addDates($table);
        });


        
    }

    private function _addIdsAndTitle($table, $citiField = true)
    {

        if ($citiField)
        {

            $table->integer('citi_id')->unique()->primary();
            $table->uuid('lake_guid')->unique()->nullable();

        }
        else
        {

            $table->uuid('lake_guid')->unique()->primary();

        }
            
        $table->string('title');
        $table->string('lake_uri')->unique()->nullable();
        return $table;
    }

    private function _addDates($table)
    {
        $table->timestamp('api_created_at')->nullable()->useCurrent();
        $table->timestamp('api_modified_at')->nullable()->useCurrent();
        $table->timestamp('api_indexed_at')->nullable()->useCurrent();
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

        Schema::dropIfExists('images');
        Schema::dropIfExists('category_text');
        Schema::dropIfExists('texts');
        Schema::dropIfExists('category_video');
        Schema::dropIfExists('videos');
        Schema::dropIfExists('category_sound');
        Schema::dropIfExists('sounds');
        Schema::dropIfExists('category_link');
        Schema::dropIfExists('links');
        Schema::dropIfExists('themes');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('artwork_category');
        Schema::dropIfExists('artworks');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('artists');
        Schema::dropIfExists('agent_types');

    }

}
