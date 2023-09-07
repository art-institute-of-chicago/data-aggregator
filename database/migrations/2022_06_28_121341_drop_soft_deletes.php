<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    // aka the `deleted_at` column
    private $tables = [
        'articles',
        'educator_resources',
        'event_programs',
        'events',
        'generic_pages',
        'highlights',
        'issue_articles',
        'issues',
        'press_releases',
        'printed_catalogs',
        'web_artists',
        'web_exhibitions',
    ];

    public function up(): void
    {
        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->softDeletes()->after('updated_at');
            });
        }
    }
};
