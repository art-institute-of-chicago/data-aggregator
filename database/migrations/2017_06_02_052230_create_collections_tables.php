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

        Schema::create('citilake_agent_types', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table = $this->_addDates($table);
        });

        Schema::create('citilake_agents', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->integer('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->integer('death_date')->nullable();
            $table->string('death_place')->nullable();
            $table->boolean('licensing_restricted')->nullable();
            $table->integer('agent_type_citi_id')->nullable();
            $table->foreign('agent_type_citi_id')->references('citi_id')->on('citilake_agent_types');
            $table = $this->_addDates($table);
        });

        Schema::create('citilake_departments', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table = $this->_addDates($table);
        });

        Schema::create('citilake_object_types', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table = $this->_addDates($table);
        });

        Schema::create('citilake_categories', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->text('description')->nullable();
            $table->boolean('is_in_nav')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('sort')->nullable();
            $table->integer('type')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('citilake_galleries', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->string('closed')->nullable();
            $table->string('number')->nullable();
            $table->integer('floor')->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('citilake_category_gallery', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('gallery_citi_id');
            $table->foreign('gallery_citi_id')->references('citi_id')->on('citilake_galleries')->onDelete('cascade');
            $table->uuid('category_lake_guid');
            $table->foreign('category_lake_guid')->references('lake_guid')->on('citilake_categories')->onDelete('cascade');
        });

        Schema::create('citilake_artworks', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->string('main_id')->nullable();
            $table->string('date_display')->nullable();
            $table->integer('date_start')->nullable();
            $table->integer('date_end')->nullable();
            $table->text('description')->nullable();
            $table->string('artist_display')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('medium')->nullable();
            $table->string('credit_line')->nullable();
            $table->string('inscriptions')->nullable();
            $table->text('publications')->nullable();
            $table->text('exhibitions')->nullable();
            $table->text('provenance')->nullable();
            $table->string('publishing_verification_level')->nullable();
            $table->boolean('is_public_domain')->nullable();
            $table->string('copyright_notice')->nullable();
            $table->string('place_of_origin')->nullable();
            $table->string('collection_status')->nullable();
            $table->integer('department_citi_id')->nullable();
            $table->foreign('department_citi_id')->references('citi_id')->on('citilake_departments');
            $table->integer('object_type_citi_id')->nullable();
            $table->foreign('object_type_citi_id')->references('citi_id')->on('citilake_object_types');
            $table->integer('gallery_citi_id')->nullable();
            $table->foreign('gallery_citi_id')->references('citi_id')->on('citilake_galleries');
            $table = $this->_addDates($table);
        });

        Schema::create('citilake_artwork_category', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id');
            $table->foreign('artwork_citi_id')->references('citi_id')->on('citilake_artworks')->onDelete('cascade');
            $table->uuid('category_lake_guid');
            $table->foreign('category_lake_guid')->references('lake_guid')->on('citilake_categories')->onDelete('cascade');
        });

        Schema::create('citilake_agent_artwork', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id');
            $table->foreign('artwork_citi_id')->references('citi_id')->on('citilake_artworks')->onDelete('cascade');
            $table->integer('agent_citi_id');
            $table->foreign('agent_citi_id')->references('citi_id')->on('citilake_agents')->onDelete('cascade');
        });

        Schema::create('citilake_artwork_dates', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id');
            $table->foreign('artwork_citi_id')->references('citi_id')->on('citilake_artworks')->onDelete('cascade');
            $table->date('date')->nullable();
            $table->string('qualifier')->nullable();
            $table->boolean('preferred')->nullable();
            $table->timestamps();
        });

        Schema::create('citilake_artwork_committees', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id');
            $table->foreign('artwork_citi_id')->references('citi_id')->on('citilake_artworks')->onDelete('cascade');
            $table->string('committee')->nullable();
            $table->date('date')->nullable();
            $table->string('action')->nullable();
            $table->timestamps();
        });

        Schema::create('citilake_artwork_terms', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id');
            $table->foreign('artwork_citi_id')->references('citi_id')->on('citilake_artworks')->onDelete('cascade');
            $table->string('term')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });

        Schema::create('citilake_artwork_catalogues', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id');
            $table->foreign('artwork_citi_id')->references('citi_id')->on('citilake_artworks')->onDelete('cascade');
            $table->boolean('preferred')->nullable();
            $table->string('catalogue')->nullable();
            $table->integer('number')->nullable();
            $table->string('state_edition')->nullable();
            $table->timestamps();
        });

        Schema::create('citilake_artwork_artwork', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('set_citi_id');
            $table->foreign('set_citi_id')->references('citi_id')->on('citilake_artworks')->onDelete('cascade');
            $table->integer('part_citi_id');
            $table->foreign('part_citi_id')->references('citi_id')->on('citilake_artworks')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('citilake_themes', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->text('description')->nullable();
            $table->string('is_in_navigation')->nullable();
            $table->string('sort')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('citilake_links', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table, false);
            $table->text('description')->nullable();
            $table->string('content')->nullable();
            $table->string('published')->nullable();
            $table->integer('agent_citi_id')->nullable();
            $table->foreign('agent_citi_id')->references('citi_id')->on('citilake_agents');
            $table = $this->_addDates($table, false);
        });

        Schema::create('citilake_category_link', function(Blueprint $table) {
            $table->increments('id');
            $table->uuid('link_lake_guid');
            $table->foreign('link_lake_guid')->references('lake_guid')->on('citilake_links')->onDelete('cascade');
            $table->uuid('category_lake_guid');
            $table->foreign('category_lake_guid')->references('lake_guid')->on('citilake_categories')->onDelete('cascade');
        });

        Schema::create('citilake_sounds', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table, false);
            $table->text('description')->nullable();
            $table->string('content')->nullable();
            $table->string('published')->nullable();
            $table->integer('agent_citi_id')->nullable();
            $table->foreign('agent_citi_id')->references('citi_id')->on('citilake_agents');
            $table = $this->_addDates($table, false);
        });

        Schema::create('citilake_category_sound', function(Blueprint $table) {
            $table->increments('id');
            $table->uuid('sound_lake_guid');
            $table->foreign('sound_lake_guid')->references('lake_guid')->on('citilake_sounds')->onDelete('cascade');
            $table->uuid('category_lake_guid');
            $table->foreign('category_lake_guid')->references('lake_guid')->on('citilake_categories')->onDelete('cascade');
        });

        Schema::create('citilake_videos', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table, false);
            $table->text('description')->nullable();
            $table->string('content')->nullable();
            $table->string('published')->nullable();
            $table->integer('agent_citi_id')->nullable();
            $table->foreign('agent_citi_id')->references('citi_id')->on('citilake_agents');
            $table = $this->_addDates($table, false);
        });

        Schema::create('citilake_category_video', function(Blueprint $table) {
            $table->increments('id');
            $table->uuid('video_lake_guid');
            $table->foreign('video_lake_guid')->references('lake_guid')->on('citilake_videos')->onDelete('cascade');
            $table->uuid('category_lake_guid');
            $table->foreign('category_lake_guid')->references('lake_guid')->on('citilake_categories')->onDelete('cascade');
        });

        Schema::create('citilake_texts', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table, false);
            $table->text('description')->nullable();
            $table->string('content')->nullable();
            $table->string('published')->nullable();
            $table->integer('agent_citi_id')->nullable();
            $table->foreign('agent_citi_id')->references('citi_id')->on('citilake_agents');
            $table = $this->_addDates($table, false);
        });

        Schema::create('citilake_category_text', function(Blueprint $table) {
            $table->increments('id');
            $table->uuid('text_lake_guid');
            $table->foreign('text_lake_guid')->references('lake_guid')->on('citilake_texts')->onDelete('cascade');
            $table->uuid('category_lake_guid');
            $table->foreign('category_lake_guid')->references('lake_guid')->on('citilake_categories')->onDelete('cascade');
        });

        Schema::create('citilake_images', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table, false);
            $table->text('description')->nullable();
            $table->string('content')->nullable();
            $table->string('published')->nullable();
            $table->integer('agent_citi_id')->nullable();
            $table->foreign('agent_citi_id')->references('citi_id')->on('citilake_agents');
            $table->string('type')->nullable();
            $table->string('iiif_url')->unique()->nullable();
            $table->boolean('preferred')->nullable();
            $table = $this->_addDates($table, false);
        });

        Schema::create('citilake_category_image', function(Blueprint $table) {
            $table->increments('id');
            $table->uuid('image_lake_guid');
            $table->foreign('image_lake_guid')->references('lake_guid')->on('citilake_images')->onDelete('cascade');
            $table->uuid('category_lake_guid');
            $table->foreign('category_lake_guid')->references('lake_guid')->on('citilake_categories')->onDelete('cascade');
        });

        Schema::create('citilake_artwork_image', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id');
            $table->foreign('artwork_citi_id')->references('citi_id')->on('citilake_artworks')->onDelete('cascade');
            $table->uuid('image_lake_guid');
            $table->foreign('image_lake_guid')->references('lake_guid')->on('citilake_images')->onDelete('cascade');
        });

        Schema::create('citilake_exhibitions', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->integer('department_citi_id')->nullable();
            $table->foreign('department_citi_id')->references('citi_id')->on('citilake_departments');
            $table->integer('gallery_citi_id');
            $table->foreign('gallery_citi_id')->references('citi_id')->on('citilake_galleries')->onDelete('cascade');
            $table->string('dates')->nullable();
            $table->boolean('active')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('citilake_artwork_exhibition', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id');
            $table->foreign('artwork_citi_id')->references('citi_id')->on('citilake_artworks')->onDelete('cascade');
            $table->integer('exhibition_citi_id');
            $table->foreign('exhibition_citi_id')->references('citi_id')->on('citilake_exhibitions')->onDelete('cascade');
        });

        Schema::create('citilake_agent_exhibition', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_citi_id');
            $table->foreign('agent_citi_id')->references('citi_id')->on('citilake_agents')->onDelete('cascade');
            $table->integer('exhibition_citi_id');
            $table->foreign('exhibition_citi_id')->references('citi_id')->on('citilake_exhibitions')->onDelete('cascade');
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

    private function _addDates($table, $citiField = true)
    {
        $table->timestamp('api_created_at')->nullable()->useCurrent();
        $table->timestamp('api_modified_at')->nullable()->useCurrent();
        $table->timestamp('api_indexed_at')->nullable()->useCurrent();

        if ($citiField)
        {

            $table->timestamp('citi_created_at')->nullable()->useCurrent();
            $table->timestamp('citi_modified_at')->nullable()->useCurrent();

        }

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

        Schema::dropIfExists('citilake_agent_exhibition');
        Schema::dropIfExists('citilake_artwork_exhibition');
        Schema::dropIfExists('citilake_exhibitions');
        Schema::dropIfExists('citilake_artwork_image');
        Schema::dropIfExists('citilake_category_image');
        Schema::dropIfExists('citilake_images');
        Schema::dropIfExists('citilake_category_text');
        Schema::dropIfExists('citilake_texts');
        Schema::dropIfExists('citilake_category_video');
        Schema::dropIfExists('citilake_videos');
        Schema::dropIfExists('citilake_category_sound');
        Schema::dropIfExists('citilake_sounds');
        Schema::dropIfExists('citilake_category_link');
        Schema::dropIfExists('citilake_links');
        Schema::dropIfExists('citilake_themes');
        Schema::dropIfExists('citilake_artwork_artwork');
        Schema::dropIfExists('citilake_artwork_committees');
        Schema::dropIfExists('citilake_artwork_dates');
        Schema::dropIfExists('citilake_artwork_terms');
        Schema::dropIfExists('citilake_artwork_catalogues');
        Schema::dropIfExists('citilake_agent_artwork');
        Schema::dropIfExists('citilake_artwork_category');
        Schema::dropIfExists('citilake_artworks');
        Schema::dropIfExists('citilake_category_gallery');
        Schema::dropIfExists('citilake_galleries');
        Schema::dropIfExists('citilake_categories');
        Schema::dropIfExists('citilake_object_types');
        Schema::dropIfExists('citilake_departments');
        Schema::dropIfExists('citilake_agents');
        Schema::dropIfExists('citilake_agent_types');

    }

}
