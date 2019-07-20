<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdateAtIndexes extends Migration
{
    /**
     * TODO: Create custom `timestamps()` function?
     */
    private $tableNames = [
        'agent_roles',
        'agent_types',
        'agents',
        'archival_images',
        'articles',
        'artwork_date_qualifiers',
        'artwork_dates',
        'artwork_place_qualifiers',
        'artwork_types',
        'artworks',
        'assets',
        'catalogues',
        'category_terms',
        'closures',
        'commands',
        'events',
        'exhibitions',
        'galleries',
        'hours',
        'library_material_creator',
        'library_material_subject',
        'library_materials',
        'library_terms',
        'locations',
        'mobile_artworks',
        'mobile_sounds',
        'places',
        'products',
        'publications',
        'sections',
        'selections',
        'shop_categories',
        'sites',
        'tags',
        'ticketed_events',
        'tour_stops',
        'tours',
        'web_artists',
        'web_exhibitions',
    ];

    public function up()
    {
        // TODO: Creating indexes isn't friendly with SQLite
        if (App::environment('testing')) {
            return;
        }

        foreach ($this->tableNames as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->index('updated_at');
            });
        }
    }

    public function down()
    {
        foreach ($this->tableNames as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropIndex(['updated_at']);
            });
        }
    }
}
