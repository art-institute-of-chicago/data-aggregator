<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('artwork_types', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table = $this->_addDates($table);
        });

        Schema::create('agent_types', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table = $this->_addDates($table);
        });

        Schema::create('agent_roles', function (Blueprint $table) {
            $table->integer('citi_id')->signed()->primary();
            $table->string('title')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('artwork_date_qualifiers', function (Blueprint $table) {
            $table->integer('citi_id')->unsigned()->primary();
            $table->string('title')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('artwork_place_qualifiers', function (Blueprint $table) {
            $table->integer('citi_id')->signed()->primary();
            $table->string('title')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('catalogues', function (Blueprint $table) {
            $table->integer('citi_id')->primary();
            $table->string('title')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('category_terms', function (Blueprint $table) {
            $table->string('lake_uid')->primary();
            $table->string('title')->nullable();

            $table->boolean('is_category')->index();
            $table->string('subtype')->index();

            // Category fields
            $table->string('parent_id')->nullable()->index();

            $table = $this->_addDates($table);
        });

        Schema::create('places', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->double('latitude', 16, 13)->nullable();
            $table->double('longitude', 16, 13)->nullable();
            $table = $this->_addDates($table);
            $table->string('type')->nullable();
        });

        Schema::create('galleries', function (Blueprint $table) {
            $table->integer('citi_id')->unsigned()->primary();
            $table->string('title')->nullable();
            $table->boolean('is_closed')->nullable();
            $table->string('number')->nullable();
            $table->string('floor')->nullable();
            $table->double('latitude', 16, 13)->nullable();
            $table->double('longitude', 16, 13)->nullable();
            $table->string('type')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('agents', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->string('sort_title')->nullable();
            $table->integer('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->integer('death_date')->nullable();
            $table->string('death_place')->nullable();
            $table->boolean('licensing_restricted')->nullable();
            $table->string('ulan_uri')->nullable();
            $table->json('alt_titles')->nullable();
            $table->integer('agent_type_citi_id')->nullable()->index();
            $table = $this->_addDates($table);
            $table->json('agent_ids')->nullable();
        });

        Schema::create('exhibitions', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table, true, 'text');
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->integer('place_citi_id')->nullable()->index();
            $table->string('place_display')->nullable();
            $table->string('department_display')->nullable();
            $table->string('status')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->date('date_aic_start')->nullable();
            $table->date('date_aic_end')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('artworks', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table, true, 'text');
            $table->json('alt_titles')->nullable();
            $table->string('main_id')->nullable();
            $table->integer('pageviews')->nullable()->index();
            $table->text('date_display')->nullable();
            $table->integer('date_start')->nullable();
            $table->integer('date_end')->nullable();
            $table->text('description')->nullable();
            $table->text('artist_display')->nullable();
            $table->text('dimensions')->nullable();
            $table->text('medium_display')->nullable();
            $table->text('credit_line')->nullable();
            $table->text('inscriptions')->nullable();
            $table->text('publication_history')->nullable();
            $table->text('exhibition_history')->nullable();
            $table->text('provenance')->nullable();
            $table->integer('fiscal_year')->nullable();
            $table->integer('fiscal_year_deaccession')->nullable()->index();
            $table->string('publishing_verification_level')->nullable();
            $table->boolean('is_public_domain')->nullable();
            $table->boolean('is_zoomable')->nullable();
            $table->integer('max_zoom_window_size')->nullable();
            $table->string('copyright_notice')->nullable();
            $table->string('place_of_origin')->nullable();
            $table->string('collection_status')->nullable();
            $table->integer('internal_department_id')->unsigned()->nullable();
            $table->integer('artwork_type_citi_id')->nullable()->index();
            $table->integer('gallery_citi_id')->nullable()->index();
            $table->boolean('is_on_view')->nullable();
            $table = $this->_addDates($table);
            $table->integer('pageviews_recent')->nullable()->index();
        });

        Schema::create('artwork_artist', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->index();
            $table->integer('agent_citi_id')->index();

            // Should default to id of Artist (219) - in code?
            $table->integer('agent_role_citi_id')->default(219)->unsigned()->index();

            // Should default to true - in code?
            $table->boolean('preferred')->default(true)->index();
        });

        Schema::create('artwork_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->integer('artwork_citi_id')->index();
            $table->date('date_earliest')->nullable();
            $table->date('date_latest')->nullable();
            $table->integer('artwork_date_qualifier_citi_id')->nullable();
            $table->boolean('preferred')->default(false)->nullable();
            $table->timestamps();
        });

        Schema::create('artwork_place', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->signed()->index();
            $table->integer('place_citi_id')->signed()->index();
            $table->integer('artwork_place_qualifier_citi_id')->signed()->index();
            $table->boolean('preferred')->index();
        });

        Schema::create('artwork_catalogue', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->nullable();
            $table->integer('catalogue_citi_id')->nullable();
            $table->text('number')->nullable();
            $table->text('state_edition')->nullable();
            $table->boolean('preferred')->default(false);
        });

        Schema::create('artwork_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->index();
            $table->string('category_lake_uid')->nullable()->index();
        });

        Schema::create('artwork_term', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->nullable()->index();
            $table->string('term_lake_uid')->nullable()->index();
            $table->boolean('preferred')->nullable()->default(false)->index();
        });

        Schema::create('artwork_exhibition', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->index();
            $table->integer('exhibition_citi_id')->index();
        });

        Schema::create('assets', function (Blueprint $table) {
            $table->uuid('lake_guid')->primary();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->integer('copyright_notice')->nullable();
            $table->string('published')->nullable();
            $table->boolean('is_multimedia_resource')->default(false)->index();
            $table->boolean('is_educational_resource')->default(false)->index();
            $table->boolean('is_teacher_resource')->default(false)->index();
            $table->string('type')->nullable()->index();
            $table->json('metadata')->nullable();
            $table->string('content_e_tag', 40)->nullable();
            $table->timestamp('content_modified_at')->nullable();
            $table->timestamp('source_created_at')->nullable();
            $table->timestamp('source_modified_at')->nullable();
            $table->timestamp('source_indexed_at')->nullable();
            $table->timestamps();
            $table->text('alt_text')->nullable();
        });

        Schema::create('artwork_asset', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->index();
            $table->uuid('asset_lake_guid')->index();
            $table->boolean('preferred')->default(false)->nullable();
            $table->boolean('is_doc')->default(false)->index();
        });

        Schema::create('exhibition_asset', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exhibition_citi_id')->signed()->index();
            $table->uuid('asset_lake_guid')->index();
            $table->boolean('is_doc')->default(false)->index();
            $table->boolean('preferred')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('artwork_types');
        Schema::dropIfExists('agent_types');
        Schema::dropIfExists('agent_roles');
        Schema::dropIfExists('artwork_date_qualifiers');
        Schema::dropIfExists('artwork_place_qualifiers');
        Schema::dropIfExists('catalogues');
        Schema::dropIfExists('category_terms');

        Schema::dropIfExists('places');
        Schema::dropIfExists('galleries');

        Schema::dropIfExists('agents');
        Schema::dropIfExists('exhibitions');
        Schema::dropIfExists('artworks');

        Schema::dropIfExists('artwork_artist');
        Schema::dropIfExists('artwork_dates');
        Schema::dropIfExists('artwork_place');
        Schema::dropIfExists('artwork_catalogue');
        Schema::dropIfExists('artwork_category');
        Schema::dropIfExists('artwork_term');
        Schema::dropIfExists('artwork_exhibition');

        Schema::dropIfExists('assets');
        Schema::dropIfExists('exhibition_asset');
        Schema::dropIfExists('artwork_asset');
    }

    private function _addIdsAndTitle($table, $citiField = true, $titleField = 'string')
    {
        $table->integer('citi_id')->primary();
        $table->{$titleField}('title')->nullable();
        return $table;
    }

    private function _addDates($table, $citiField = true)
    {
        $table->timestamp('source_modified_at')->nullable();
        $table->timestamps();
        return $table;
    }
};
