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
            $table->string('ulan_uri')->nullable();
            $table->integer('agent_type_citi_id')->nullable()->unsigned()->index();
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
            $table->double('latitude', 16, 13)->nullable();
            $table->double('longitude', 16, 13)->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('category_gallery', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('gallery_citi_id')->unsigned()->index();
            $table->integer('category_citi_id')->unsigned()->index();
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
            $table->integer('object_type_citi_id')->nullable()->unsigned()->index();
            $table->integer('gallery_citi_id')->nullable()->unsigned()->index();
            $table = $this->_addDates($table);
        });

        Schema::create('artwork_category', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->unsigned()->index();
            $table->integer('category_citi_id')->unsigned()->index();
        });

        foreach( ['artwork_artist', 'artwork_copyright_representative'] as $artwork_agent ) {

            Schema::create($artwork_agent, function(Blueprint $table) {
                $table->increments('id');
                $table->integer('artwork_citi_id')->unsigned()->index();
                $table->integer('agent_citi_id')->unsigned()->index();
            });

        }

        Schema::create('artwork_dates', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->unsigned()->index();
            $table->date('date')->nullable();
            $table->string('qualifier')->nullable();
            $table->boolean('preferred')->nullable();
            $table->timestamps();
        });

        Schema::create('artwork_committees', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->unsigned()->index();
            $table->string('committee')->nullable();
            $table->date('date')->nullable();
            $table->string('action')->nullable();
            $table->timestamps();
        });

        Schema::create('artwork_terms', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->unsigned()->index();
            $table->string('term')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });

        Schema::create('artwork_catalogues', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->unsigned()->index();
            $table->boolean('preferred')->nullable();
            $table->string('catalogue')->nullable();
            $table->integer('number')->nullable();
            $table->string('state_edition')->nullable();
            $table->timestamps();
        });

        Schema::create('artwork_artwork', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('set_citi_id')->unsigned()->index();
            $table->integer('part_citi_id')->unsigned()->index();
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
            $table->integer('category_citi_id')->unsigned()->index();
        });

        Schema::create('artwork_asset', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->unsigned()->index();
            $table->uuid('asset_lake_guid')->index('artwork_asset_asset_lake_guid_foreign');
            $table->boolean('preferred')->nullable();
        });

        Schema::create('exhibitions', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table, true, 'text');
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->integer('department_citi_id')->nullable()->unsigned()->index();
            $table->integer('gallery_citi_id')->nullable()->unsigned()->index();
            $table->string('gallery_display')->nullable();
            $table->string('status')->nullable();
            $table->uuid('asset_lake_guid')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->date('date_aic_start')->nullable();
            $table->date('date_aic_end')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('artwork_exhibition', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->unsigned()->index();
            $table->integer('exhibition_citi_id')->unsigned()->index();
        });

        Schema::create('agent_exhibition', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_citi_id')->unsigned()->index();
            $table->integer('exhibition_citi_id')->unsigned()->index();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->boolean('is_host')->nullable();
            $table->boolean('is_organizer')->nullable();
            $table->integer('agent_citi_id')->unsigned()->nullable()->change();
            $table->integer('exhibition_citi_id')->unsigned()->nullable()->change();
            $table->timestamp('source_created_at')->nullable();
            $table->timestamp('source_modified_at')->nullable();
            $table->timestamp('source_indexed_at')->nullable();
            $table->timestamp('citi_created_at')->nullable();
            $table->timestamp('citi_modified_at')->nullable();
            $table->timestamps();
        });


    }

    private function _addInterpretiveResourceFileds($table)
    {

        $table->text('description')->nullable();
        $table->text('content')->nullable();
        $table->string('published')->nullable();
        $table->integer('agent_citi_id')->nullable()->unsigned()->index();

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
        Schema::dropIfExists('artwork_artist');
        Schema::dropIfExists('artwork_copyright_representative');
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
