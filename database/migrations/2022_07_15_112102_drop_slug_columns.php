<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        foreach (
            [
            'digital_catalogs',
            'digital_publication_sections',
            'educator_resources',
            'generic_pages',
            'press_releases',
            'printed_catalogs',
            ] as $tableName
        ) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn('slug');
            });
        }
    }

    public function down(): void
    {
        foreach (
            [
            'digital_catalogs',
            'digital_publication_sections',
            'educator_resources',
            'generic_pages',
            'press_releases',
            'printed_catalogs',
            ] as $tableName
        ) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->string('slug')->nullable()->after('web_url');
            });
        }
    }
};
