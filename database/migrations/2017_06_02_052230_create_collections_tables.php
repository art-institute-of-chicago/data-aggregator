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
        Schema::create('artists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('citi_id')->unique();
            $table->string('title');
            $table->string('lake_guid')->unique()->nullable();
            $table->string('lake_uri')->unique()->nullable();
            $table->integer('date_birth')->nullable();
            $table->integer('date_death')->nullable();
            $table->timestamp('api_created_at')->nullable()->useCurrent();
            $table->timestamp('api_modified_at')->nullable()->useCurrent();
            $table->timestamp('api_indexed_at')->nullable()->useCurrent();
            $table->timestamps();
        });

        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('citi_id')->unique();
            $table->string('title');
            $table->string('lake_guid')->unique()->nullable();
            $table->string('lake_uri')->unique()->nullable();
            $table->timestamp('api_created_at')->nullable()->useCurrent();
            $table->timestamp('api_modified_at')->nullable()->useCurrent();
            $table->timestamp('api_indexed_at')->nullable()->useCurrent();
            $table->timestamps();
        });

        Schema::create('artworks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('citi_id')->unique();
            $table->string('title');
            $table->string('lake_guid')->unique()->nullable();
            $table->string('lake_uri')->unique()->nullable();
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
            $table->timestamp('api_created_at')->nullable()->useCurrent();
            $table->timestamp('api_modified_at')->nullable()->useCurrent();
            $table->timestamp('api_indexed_at')->nullable()->useCurrent();
            $table->timestamps();
        });


        Schema::create('galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('citi_id')->unique();
            $table->string('title');
            $table->string('lake_guid')->unique()->nullable();
            $table->string('lake_uri')->unique()->nullable();
            $table->string('closed')->nullable();
            $table->string('number')->nullable();
            $table->integer('floor')->nullable();
            $table->string('category')->nullable();
            $table->timestamp('api_created_at')->nullable()->useCurrent();
            $table->timestamp('api_modified_at')->nullable()->useCurrent();
            $table->timestamp('api_indexed_at')->nullable()->useCurrent();
            $table->timestamps();
        });

        Schema::create('themes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('citi_id')->unique();
            $table->string('title');
            $table->string('lake_guid')->unique()->nullable();
            $table->string('lake_uri')->unique()->nullable();
            $table->text('description')->nullable();
            $table->string('is_in_navigation')->nullable();
            $table->string('sort')->nullable();
            $table->timestamp('api_created_at')->nullable()->useCurrent();
            $table->timestamp('api_modified_at')->nullable()->useCurrent();
            $table->timestamp('api_indexed_at')->nullable()->useCurrent();
            $table->timestamps();
        });

        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('citi_id')->unique();
            $table->string('title');
            $table->string('lake_guid')->unique()->nullable();
            $table->string('lake_uri')->unique()->nullable();
            $table->text('description')->nullable();
            $table->integer('artist_citi_id')->nullable();
            $table->foreign('artist_citi_id')->references('citi_id')->on('artists');
            $table->string('asset_type')->nullable();
            $table->string('asset_url')->nullable();
            $table->string('curriculum')->nullable();
            $table->string('grade_level')->nullable();
            $table->string('resource_type')->nullable();
            $table->timestamp('api_created_at')->nullable()->useCurrent();
            $table->timestamp('api_modified_at')->nullable()->useCurrent();
            $table->timestamp('api_indexed_at')->nullable()->useCurrent();
            $table->timestamps();
        });

        Schema::create('sounds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('citi_id')->unique();
            $table->string('title');
            $table->string('lake_guid')->unique()->nullable();
            $table->string('lake_uri')->unique()->nullable();
            $table->string('type')->nullable();
            $table->timestamp('api_created_at')->nullable()->useCurrent();
            $table->timestamp('api_modified_at')->nullable()->useCurrent();
            $table->timestamp('api_indexed_at')->nullable()->useCurrent();
            $table->timestamps();
        });

        Schema::create('texts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('citi_id')->unique();
            $table->string('title');
            $table->string('lake_guid')->unique()->nullable();
            $table->string('lake_uri')->unique()->nullable();
            $table->string('title_alt')->nullable();
            $table->string('curriculum')->nullable();
            $table->string('grade_level')->nullable();
            $table->string('resource_type')->nullable();
            $table->timestamp('api_created_at')->nullable()->useCurrent();
            $table->timestamp('api_modified_at')->nullable()->useCurrent();
            $table->timestamp('api_indexed_at')->nullable()->useCurrent();
            $table->timestamps();
        });

        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('citi_id')->unique();
            $table->string('title');
            $table->string('lake_guid')->unique()->nullable();
            $table->string('lake_uri')->unique()->nullable();
            $table->string('imaging_uid')->nullable();
            $table->string('type')->nullable();
            $table->timestamp('api_created_at')->nullable()->useCurrent();
            $table->timestamp('api_modified_at')->nullable()->useCurrent();
            $table->timestamp('api_indexed_at')->nullable()->useCurrent();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('citi_id')->unique();
            $table->string('title');
            $table->string('lake_guid')->unique()->nullable();
            $table->string('lake_uri')->unique()->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_in_nav')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('sort')->nullable();
            $table->integer('type')->nullable();
            $table->timestamp('api_created_at')->nullable()->useCurrent();
            $table->timestamp('api_modified_at')->nullable()->useCurrent();
            $table->timestamp('api_indexed_at')->nullable()->useCurrent();
            $table->timestamps();
        });

        Schema::create('artwork_category', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id');
            $table->integer('category_citi_id');

            $table->foreign('artwork_citi_id')->references('citi_id')->on('artworks')->onDelete('cascade');
            $table->foreign('category_citi_id')->references('citi_id')->on('categories')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('artwork_category');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('images');
        Schema::dropIfExists('texts');
        Schema::dropIfExists('sounds');
        Schema::dropIfExists('videos');
        Schema::dropIfExists('themes');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('artworks');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('artists');

    }
}
