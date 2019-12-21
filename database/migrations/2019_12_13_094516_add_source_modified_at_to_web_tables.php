<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSourceModifiedAtToWebTables extends Migration
{
    private $tables = [
        // 'locations' => 'published', // needs, dropped
        // 'hours', // has
        'closures' => 'type', // needs
        'web_exhibitions' => 'is_featured', // needs
        'events' => 'publish_end_date', // needs
        // 'event_occurrences', // has
        'event_programs' => 'is_event_host', // needs
        'articles' => 'publish_end_date', // needs
        // 'email_series', // has
        // 'selections', // has
        'web_artists' => 'datahub_id', // needs
        // 'static_pages' => 'web_url', // hardcoded?
        'generic_pages' => 'imgix_uuid', // needs
        'press_releases' => 'imgix_uuid', // needs
        // 'research_guides' => 'imgix_uuid', // needs, dropped
        'educator_resources' => 'imgix_uuid', // needs
        'digital_catalogs' => 'imgix_uuid', // needs
        'printed_catalogs' => 'imgix_uuid', // needs
        // 'interactive_features', // has
        // 'experiences', // has
        'sponsors' => 'published', // needs
    ];

    public function up()
    {
        foreach ($this->tables as $table => $previousColumn) {
            Schema::table($table, function (Blueprint $table) use ($previousColumn) {
                $table->timestamp('source_modified_at')->nullable()->after($previousColumn);
            });
        }
    }

    public function down()
    {
        foreach ($this->tables as $table => $previousColumn) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('source_modified_at');
            });
        }
    }
}
