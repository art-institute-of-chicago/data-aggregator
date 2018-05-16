<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdateAtIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // TODO: Creating indexes isn't friendly with SQLite
        if (App::environment('testing'))
        {
            return;
        }

        Schema::table('agent_exhibition', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('agent_place', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('agent_roles', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('agent_types', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('agents', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('archival_images', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('articles', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('artwork_artwork', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('artwork_catalogue', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('artwork_date_qualifiers', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('artwork_dates', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('artwork_place_qualifiers', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('artwork_term', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('artwork_types', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('artworks', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('assets', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('catalogues', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('category_terms', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('closures', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('commands', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('events', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('exhibitions', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('galleries', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('hours', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('legacy_events', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('library_material_creator', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('library_material_subject', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('library_materials', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('library_terms', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('locations', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('mobile_artworks', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('mobile_sounds', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('pages', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('places', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('products', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('publications', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('sections', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('selections', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('shop_categories', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('sites', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('tags', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('ticketed_events', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('tour_stops', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('tours', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('web_artists', function(Blueprint $table) {
            $table->index('updated_at');
        });

        Schema::table('web_exhibitions', function(Blueprint $table) {
            $table->index('updated_at');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {


        Schema::table('agent_exhibition', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('agent_place', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('agent_roles', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('agent_types', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('agents', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('archival_images', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('articles', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('artwork_artwork', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('artwork_catalogue', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('artwork_date_qualifiers', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('artwork_dates', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('artwork_place_qualifiers', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('artwork_term', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('artwork_types', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('artworks', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('assets', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('catalogues', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('category_terms', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('closures', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('commands', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('events', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('exhibitions', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('galleries', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('hours', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('legacy_events', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('library_material_creator', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('library_material_subject', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('library_materials', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('library_terms', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('locations', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('mobile_artworks', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('mobile_sounds', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('pages', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('places', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('products', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('publications', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('sections', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('selections', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('shop_categories', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('sites', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('tags', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('ticketed_events', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('tour_stops', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('tours', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('web_artists', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

        Schema::table('web_exhibitions', function(Blueprint $table) {
            $table->dropIndex(['updated_at']);
        });

    }
}
