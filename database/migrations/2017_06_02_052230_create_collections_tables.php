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
        Schema::create('artworks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('api_id');
            $table->string('title');
            $table->integer('citi_id');
            $table->string('main_id');
            $table->string('lake_uid');
            $table->string('lake_guid');
            $table->string('lake_uri');
            $table->string('title_raw');
            $table->string('title_display');
            $table->integer('date_start');
            $table->integer('date_end');
            $table->string('date_display');
            $table->string('creator_lake_uid');
            $table->string('creator_raw');
            $table->string('creator_display');
            $table->string('department_lake_uid');
            $table->string('department_display');
            $table->string('dimensions');
            $table->string('medium_raw');
            $table->string('medium_display');
            $table->string('inscriptions');
            $table->string('credit_line');
            $table->text('history_publications');
            $table->text('history_exhibitions');
            $table->text('history_provenance');
            $table->dateTime('api_created_at');
            $table->string('api_created_by');
            $table->dateTime('api_modified_at');
            $table->string('api_modified_by');
            $table->timestamps();
        });

        Schema::create('artists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('api_id');
            $table->string('title');
            $table->integer('citi_id');
            $table->string('lake_uid');
            $table->string('lake_guid');
            $table->string('lake_uri');
            $table->string('title_raw');
            $table->string('title_display');
            $table->dateTime('api_created_at');
            $table->string('api_created_by');
            $table->dateTime('api_modified_at');
            $table->string('api_modified_by');
            $table->timestamps();
        });

        Schema::create('galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('api_id');
            $table->string('title');
            $table->integer('citi_id');
            $table->string('lake_uid');
            $table->string('lake_guid');
            $table->string('lake_uri');
            $table->string('title_raw');
            $table->string('title_display');
            $table->string('closed');
            $table->integer('number');
            $table->integer('floor');
            $table->string('category');
            $table->dateTime('api_created_at');
            $table->string('api_created_by');
            $table->dateTime('api_modified_at');
            $table->string('api_modified_by');
            $table->timestamps();
        });

        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('api_id');
            $table->string('title');
            $table->integer('citi_id');
            $table->string('lake_uid');
            $table->string('lake_guid');
            $table->string('lake_uri');
            $table->string('title_raw');
            $table->string('title_display');
            $table->dateTime('api_created_at');
            $table->string('api_created_by');
            $table->dateTime('api_modified_at');
            $table->string('api_modified_by');
            $table->timestamps();
        });

        Schema::create('themes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('api_id');
            $table->string('title');
            $table->integer('citi_id');
            $table->string('lake_uid');
            $table->string('lake_guid');
            $table->string('lake_uri');
            $table->string('title_raw');
            $table->string('title_display');
            $table->text('description');
            $table->string('is_in_navigation');
            $table->string('sort');
            $table->dateTime('api_created_at');
            $table->string('api_created_by');
            $table->dateTime('api_modified_at');
            $table->string('api_modified_by');
            $table->timestamps();
        });

        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('api_id');
            $table->string('title');
            $table->integer('citi_id');
            $table->string('lake_uid');
            $table->string('lake_guid');
            $table->string('lake_uri');
            $table->string('title_raw');
            $table->string('title_display');
            $table->text('description');
            $table->string('artist_uri');
            $table->string('artist_name');
            $table->string('asset_type');
            $table->string('asset_url');
            $table->string('curriculum');
            $table->string('grade_level');
            $table->string('resource_type');
            $table->dateTime('api_created_at');
            $table->string('api_created_by');
            $table->dateTime('api_modified_at');
            $table->string('api_modified_by');
            $table->timestamps();
        });

        Schema::create('sounds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('api_id');
            $table->string('title');
            $table->integer('citi_id');
            $table->string('lake_uid');
            $table->string('lake_guid');
            $table->string('lake_uri');
            $table->string('title_raw');
            $table->string('title_display');
            $table->string('type');
            $table->dateTime('api_created_at');
            $table->string('api_created_by');
            $table->dateTime('api_modified_at');
            $table->string('api_modified_by');
            $table->timestamps();
        });

        Schema::create('texts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('api_id');
            $table->string('title');
            $table->integer('citi_id');
            $table->string('lake_uid');
            $table->string('lake_guid');
            $table->string('lake_uri');
            $table->string('title_raw');
            $table->string('title_display');
            $table->string('title_alt');
            $table->string('curriculum');
            $table->string('grade_level');
            $table->string('resource_type');
            $table->dateTime('api_created_at');
            $table->string('api_created_by');
            $table->dateTime('api_modified_at');
            $table->string('api_modified_by');
            $table->timestamps();
        });

        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('api_id');
            $table->string('title');
            $table->integer('citi_id');
            $table->string('lake_uid');
            $table->string('lake_guid');
            $table->string('lake_uri');
            $table->string('title_raw');
            $table->string('title_display');
            $table->string('imaging_uid');
            $table->string('type');
            $table->dateTime('api_created_at');
            $table->string('api_created_by');
            $table->dateTime('api_modified_at');
            $table->string('api_modified_by');
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
        Schema::dropIfExists('artworks');
        Schema::dropIfExists('artists');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('themes');
        Schema::dropIfExists('videos');
        Schema::dropIfExists('sounds');
        Schema::dropIfExists('texts');
        Schema::dropIfExists('images');
    }
}
