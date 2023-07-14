<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $tableNames = [
        'agent_place_qualifiers',
        'agent_roles',
        'agent_types',
        'agents',
        'articles',
        'artwork_date_qualifiers',
        'artwork_place_qualifiers',
        'artwork_types',
        'artworks',
        'assets',
        'catalogues',
        'category_terms',
        'digital_catalogs',
        'educator_resources',
        'event_occurrences',
        'event_programs',
        'events',
        'exhibitions',
        'experiences',
        'galleries',
        'generic_pages',
        'highlights',
        'interactive_features',
        'issue_articles',
        'issues',
        'places',
        'press_releases',
        'printed_catalogs',
        'products',
        'ticketed_event_types',
        'ticketed_events',
        'web_artists',
        'web_exhibitions',
    ];

    public function up()
    {
        foreach ($this->tableNames as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->timestamp('source_updated_at')->nullable()->default(null)->change();
            });
        }
    }

    public function down()
    {
        foreach ($this->tableNames as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dateTime('source_updated_at')->nullable()->default(null)->change();
            });
        }
    }
};
