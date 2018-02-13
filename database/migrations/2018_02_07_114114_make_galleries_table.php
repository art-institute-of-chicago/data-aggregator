<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('galleries', function (Blueprint $table) {
            $table->integer('citi_id')->unsigned()->unique()->primary();
            $table->uuid('lake_guid')->unique()->nullable()->index();
            $table->string('title')->nullable();
            $table->string('lake_uri')->unique()->nullable();
            $table->boolean('closed')->nullable();
            $table->string('number')->nullable();
            $table->string('floor')->nullable();
            $table->double('latitude', 16, 13)->nullable();
            $table->double('longitude', 16, 13)->nullable();
            $table->string('type')->nullable();
            $table->timestamp('source_created_at')->nullable()->useCurrent();
            $table->timestamp('source_modified_at')->nullable()->useCurrent();
            $table->timestamp('source_indexed_at')->nullable()->useCurrent();
            $table->timestamp('citi_created_at')->nullable()->useCurrent();
            $table->timestamp('citi_modified_at')->nullable()->useCurrent();
            $table->timestamps();
        });

        Schema::table('places', function (Blueprint $table) {
            $table->dropColumn('closed');
        });

        Schema::table('places', function (Blueprint $table) {
            $table->dropColumn('number');
        });

        Schema::table('places', function (Blueprint $table) {
            $table->dropColumn('floor');
        });

        Schema::table('artworks', function (Blueprint $table) {
            $table->renameColumn('place_citi_id', 'gallery_citi_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('galleries');

        Schema::table('places', function (Blueprint $table) {
            $table->boolean('closed')->nullable();
            $table->string('number')->nullable();
            $table->string('floor')->nullable();
        });

        Schema::table('artworks', function (Blueprint $table) {
            $table->renameColumn('gallery_citi_id', 'place_citi_id');
        });

    }

}
