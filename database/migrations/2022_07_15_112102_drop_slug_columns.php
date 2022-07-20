<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSlugColumns extends Migration
{
    public function up()
    {
        foreach ([
            'digital_catalogs',
            'digital_publication_sections',
            'educator_resources',
            'generic_pages',
            'press_releases',
            'printed_catalogs',
        ] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn('slug');
            });
        }
    }

    public function down()
    {
        foreach ([
            'digital_catalogs',
            'digital_publication_sections',
            'educator_resources',
            'generic_pages',
            'press_releases',
            'printed_catalogs',
        ] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->string('slug')->nullable()->after('web_url');
            });
        }
    }
}
