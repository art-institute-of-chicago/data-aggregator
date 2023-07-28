<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * API-315: The following tables were `bigIncrements`:
     *
     *   digital_publication_sections
     *   issue_articles
     *   issues
     *
     * However, I think that's just the `id()` default.
     */
    private $tables = [
        'articles',
        'digital_catalogs',
        'digital_publication_sections',
        'educator_resources',
        'event_programs',
        'events',
        'experiences',
        'generic_pages',
        'highlights',
        'interactive_features',
        'issue_articles',
        'issues',
        'press_releases',
        'printed_catalogs',
        'web_artists',
        'web_exhibitions',
    ];

    public function up()
    {
        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->unsignedInteger('id', false)->change();
            });
        }
    }

    public function down()
    {
        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->unsignedInteger('id', true)->change();
            });
        }
    }
};
