<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        foreach ([
            'articles',
            'digital_catalogs',
            'educator_resources',
            'generic_pages',
            'press_releases',
            'printed_catalogs',
        ] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn('imgix_uuid');
            });
        }
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->text('imgix_uuid')->nullable()->after('copy');
        });

        Schema::table('digital_catalogs', function (Blueprint $table) {
            $table->text('imgix_uuid')->nullable()->after('copy');
        });

        Schema::table('educator_resources', function (Blueprint $table) {
            $table->text('imgix_uuid')->nullable()->after('copy');
        });

        Schema::table('generic_pages', function (Blueprint $table) {
            $table->text('imgix_uuid')->nullable()->after('search_tags');
        });

        Schema::table('press_releases', function (Blueprint $table) {
            $table->text('imgix_uuid')->nullable()->after('copy');
        });

        Schema::table('printed_catalogs', function (Blueprint $table) {
            $table->text('imgix_uuid')->nullable()->after('copy');
        });
    }
};
