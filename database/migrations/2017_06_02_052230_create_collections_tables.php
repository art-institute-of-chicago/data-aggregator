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

        $this->down();

        Schema::create('agent_types', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table = $this->_addDates($table);
        });

        Schema::create('agents', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->integer('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->integer('death_date')->nullable();
            $table->string('death_place')->nullable();
            $table->boolean('licensing_restricted')->nullable();
            $table->boolean('is_artist')->nullable();
            $table->integer('agent_type_citi_id')->nullable()->unsigned()->index();
            $table->foreign('agent_type_citi_id')->references('citi_id')->on('agent_types');
            $table = $this->_addDates($table);
        });

        Schema::create('departments', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table = $this->_addDates($table);
        });

        Schema::create('object_types', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table = $this->_addDates($table);
        });

        Schema::create('categories', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->text('description')->nullable();
            $table->boolean('is_in_nav')->nullable();
            $table->string('parent_id')->nullable();
            $table->integer('sort')->nullable();
            $table->integer('type')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('galleries', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->boolean('closed')->nullable();
            $table->string('number')->nullable();
            $table->string('floor')->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('category_gallery', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('gallery_citi_id')->unsigned()->index();
            $table->foreign('gallery_citi_id')->references('citi_id')->on('galleries')->onDelete('cascade');
            $table->integer('category_citi_id')->unsigned()->index();
            $table->foreign('category_citi_id')->references('citi_id')->on('categories')->onDelete('cascade');
        });

        Schema::create('artworks', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table, true, 'text');
            $table->string('main_id')->nullable();
            $table->text('date_display')->nullable();
            $table->integer('date_start')->nullable();
            $table->integer('date_end')->nullable();
            $table->text('description')->nullable();
            $table->text('artist_display')->nullable();
            $table->text('dimensions')->nullable();
            $table->text('medium')->nullable();
            $table->text('credit_line')->nullable();
            $table->text('inscriptions')->nullable();
            $table->text('publication_history')->nullable();
            $table->text('exhibition_history')->nullable();
            $table->text('provenance')->nullable();
            $table->string('publishing_verification_level')->nullable();
            $table->boolean('is_public_domain')->nullable();
            $table->string('copyright_notice')->nullable();
            $table->string('place_of_origin')->nullable();
            $table->string('collection_status')->nullable();
            $table->integer('department_citi_id')->nullable()->unsigned()->index();
            $table->foreign('department_citi_id')->references('citi_id')->on('departments');
            $table->integer('object_type_citi_id')->nullable()->unsigned()->index();
            $table->foreign('object_type_citi_id')->references('citi_id')->on('object_types');
            $table->integer('gallery_citi_id')->nullable()->unsigned()->index();
            $table->foreign('gallery_citi_id')->references('citi_id')->on('galleries');
            $table = $this->_addDates($table);
        });

        Schema::create('artwork_category', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->unsigned()->index();
            $table->foreign('artwork_citi_id')->references('citi_id')->on('artworks')->onDelete('cascade');
            $table->integer('category_citi_id')->unsigned()->index();
            $table->foreign('category_citi_id')->references('citi_id')->on('categories')->onDelete('cascade');
        });

        Schema::create('agent_artwork', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->unsigned()->index();
            $table->foreign('artwork_citi_id')->references('citi_id')->on('artworks')->onDelete('cascade');
            $table->integer('agent_citi_id')->unsigned()->index();
            $table->foreign('agent_citi_id')->references('citi_id')->on('agents')->onDelete('cascade');
        });

        Schema::create('artwork_dates', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->unsigned()->index();
            $table->foreign('artwork_citi_id')->references('citi_id')->on('artworks')->onDelete('cascade');
            $table->date('date')->nullable();
            $table->string('qualifier')->nullable();
            $table->boolean('preferred')->nullable();
            $table->timestamps();
        });

        Schema::create('artwork_committees', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->unsigned()->index();
            $table->foreign('artwork_citi_id')->references('citi_id')->on('artworks')->onDelete('cascade');
            $table->string('committee')->nullable();
            $table->date('date')->nullable();
            $table->string('action')->nullable();
            $table->timestamps();
        });

        Schema::create('artwork_terms', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->unsigned()->index();
            $table->foreign('artwork_citi_id')->references('citi_id')->on('artworks')->onDelete('cascade');
            $table->string('term')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });

        Schema::create('artwork_catalogues', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->unsigned()->index();
            $table->foreign('artwork_citi_id')->references('citi_id')->on('artworks')->onDelete('cascade');
            $table->boolean('preferred')->nullable();
            $table->string('catalogue')->nullable();
            $table->integer('number')->nullable();
            $table->string('state_edition')->nullable();
            $table->timestamps();
        });

        Schema::create('artwork_artwork', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('set_citi_id')->unsigned()->index();
            $table->foreign('set_citi_id')->references('citi_id')->on('artworks')->onDelete('cascade');
            $table->integer('part_citi_id')->unsigned()->index();
            $table->foreign('part_citi_id')->references('citi_id')->on('artworks')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('themes', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->text('description')->nullable();
            $table->string('is_in_navigation')->nullable();
            $table->string('sort')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('assets', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table, false, 'text');
            $table = $this->_addInterpretiveResourceFileds($table);
            $table->string('type')->nullable()->index();
            $table->json('metadata')->nullable();
            $table = $this->_addDates($table, false);
        });

        Schema::create('asset_category', function(Blueprint $table) {
            $table->increments('id');
            $table->uuid('asset_lake_guid');
            $table->foreign('asset_lake_guid')->references('lake_guid')->on('assets')->onDelete('cascade');
            $table->integer('category_citi_id')->unsigned()->index();
            $table->foreign('category_citi_id')->references('citi_id')->on('categories')->onDelete('cascade');
        });

        Schema::create('artwork_asset', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->unsigned()->index();
            $table->foreign('artwork_citi_id')->references('citi_id')->on('artworks')->onDelete('cascade');
            $table->uuid('asset_lake_guid');
            $table->foreign('asset_lake_guid')->references('lake_guid')->on('assets')->onDelete('cascade');
            $table->boolean('preferred')->nullable();
        });

        Schema::create('exhibitions', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table, true, 'text');
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->integer('department_citi_id')->nullable()->unsigned()->index();
            $table->foreign('department_citi_id')->references('citi_id')->on('departments');
            $table->integer('gallery_citi_id')->nullable()->unsigned()->index();
            $table->foreign('gallery_citi_id')->references('citi_id')->on('galleries')->onDelete('cascade');
            $table->string('exhibition_dates')->nullable();
            $table->boolean('active')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('artwork_exhibition', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->unsigned()->index();
            $table->foreign('artwork_citi_id')->references('citi_id')->on('artworks')->onDelete('cascade');
            $table->integer('exhibition_citi_id')->unsigned()->index();
            $table->foreign('exhibition_citi_id')->references('citi_id')->on('exhibitions')->onDelete('cascade');
        });

        Schema::create('agent_exhibition', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_citi_id')->unsigned()->index();
            $table->foreign('agent_citi_id')->references('citi_id')->on('agents')->onDelete('cascade');
            $table->integer('exhibition_citi_id')->unsigned()->index();
            $table->foreign('exhibition_citi_id')->references('citi_id')->on('exhibitions')->onDelete('cascade');
        });


    }

    private function _addInterpretiveResourceFileds($table)
    {

        $table->text('description')->nullable();
        $table->text('content')->nullable();
        $table->string('published')->nullable();
        $table->integer('agent_citi_id')->nullable()->unsigned()->index();
        $table->foreign('agent_citi_id')->references('citi_id')->on('agents');

        return $table;
    }

    private function _addIdsAndTitle($table, $citiField = true, $titleField = 'string')
    {

        if ($citiField)
        {

            $table->integer('citi_id')->unsigned()->unique()->primary();
            $table->uuid('lake_guid')->unique()->nullable()->index();

        }
        else
        {

            $table->uuid('lake_guid')->unique()->primary();

        }

        $table->{$titleField}('title')->nullable();
        $table->string('lake_uri')->unique()->nullable();
        return $table;
    }

    private function _addDates($table, $citiField = true)
    {
        $table->timestamp('source_created_at')->nullable()->useCurrent();
        $table->timestamp('source_modified_at')->nullable()->useCurrent();
        $table->timestamp('source_indexed_at')->nullable()->useCurrent();

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

        Schema::dropIfExists('agent_exhibition');
        Schema::dropIfExists('artwork_exhibition');
        Schema::dropIfExists('exhibitions');
        Schema::dropIfExists('artwork_asset');
        Schema::dropIfExists('asset_category');
        Schema::dropIfExists('assets');
        Schema::dropIfExists('themes');
        Schema::dropIfExists('artwork_artwork');
        Schema::dropIfExists('artwork_committees');
        Schema::dropIfExists('artwork_dates');
        Schema::dropIfExists('artwork_terms');
        Schema::dropIfExists('artwork_catalogues');
        Schema::dropIfExists('agent_artwork');
        Schema::dropIfExists('artwork_category');
        Schema::dropIfExists('artworks');
        Schema::dropIfExists('category_gallery');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('object_types');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('agents');
        Schema::dropIfExists('agent_types');

    }

}
