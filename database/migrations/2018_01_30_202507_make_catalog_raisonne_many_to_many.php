<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeCatalogRaisonneManyToMany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('catalogues', function (Blueprint $table) {
            $table->integer('citi_id')->unique()->primary();
            $table->uuid('lake_guid')->unique()->nullable()->index();
            $table->string('title')->nullable();
            $table->string('lake_uri')->unique()->nullable();
            $table->timestamp('source_created_at')->nullable()->useCurrent();
            $table->timestamp('source_modified_at')->nullable()->useCurrent();
            $table->timestamp('source_indexed_at')->nullable()->useCurrent();
            $table->timestamp('citi_created_at')->nullable()->useCurrent();
            $table->timestamp('citi_modified_at')->nullable()->useCurrent();
            $table->timestamps();
        });

        Schema::create('artwork_catalogue', function (Blueprint $table) {
            $table->integer('artwork_citi_id')->nullable();
            $table->integer('catalogue_citi_id')->nullable();
            $table->string('number')->nullable();
            $table->string('state_edition')->nullable();
            $table->boolean('preferred')->nullable();
            $table->timestamp('source_created_at')->nullable();
            $table->timestamp('source_modified_at')->nullable();
            $table->timestamp('source_indexed_at')->nullable();
            $table->timestamp('citi_created_at')->nullable();
            $table->timestamp('citi_modified_at')->nullable();
            $table->timestamps();
        });

        Schema::dropIfExists('artwork_catalogues');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('catalogues');
        Schema::dropIfExists('artwork_catalogue');

        Schema::create('artwork_catalogues', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->unsigned()->index();
            $table->boolean('preferred')->nullable();
            $table->string('catalogue')->nullable();
            $table->integer('number')->nullable();
            $table->string('state_edition')->nullable();
            $table->timestamps();
        });

    }
}
