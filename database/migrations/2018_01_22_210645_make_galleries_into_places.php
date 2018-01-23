<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeGalleriesIntoPlaces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::rename('galleries', 'places');
        Schema::table('places', function (Blueprint $table) {
            $table->string('type')->nullable();
        });

        Schema::rename('category_gallery', 'category_place');
        Schema::table('category_place', function (Blueprint $table) {
            $table->renameColumn('gallery_citi_id', 'place_citi_id');
        });

        Schema::table('artworks', function (Blueprint $table) {
            $table->renameColumn('gallery_citi_id', 'place_citi_id');
        });

        Schema::table('exhibitions', function (Blueprint $table) {
            $table->renameColumn('gallery_citi_id', 'place_citi_id');
            $table->renameColumn('gallery_display', 'place_display');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::rename('places', 'galleries');
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        Schema::rename('category_place', 'category_gallery');
        Schema::table('category_gallery', function (Blueprint $table) {
            $table->renameColumn('place_citi_id', 'gallery_citi_id');
        });

        Schema::table('artworks', function (Blueprint $table) {
            $table->renameColumn('place_citi_id', 'gallery_citi_id');
        });

        Schema::table('exhibitions', function (Blueprint $table) {
            $table->renameColumn('place_citi_id', 'gallery_citi_id');
            $table->renameColumn('place_display', 'gallery_display');
        });

    }
}
