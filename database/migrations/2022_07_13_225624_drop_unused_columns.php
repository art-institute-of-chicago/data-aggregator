<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUnusedColumns extends Migration
{
    public function up()
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->dropColumn([
                'birth_place',
                'death_place',
            ]);
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn([
                'imgix_uuid',
            ]);
        });

        Schema::table('digital_catalogs', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'imgix_uuid',
            ]);
        });

        Schema::table('digital_publication_sections', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
            ]);
        });

        Schema::table('educator_resources', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'imgix_uuid',
            ]);
        });

        Schema::table('generic_pages', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'imgix_uuid',
            ]);
        });

        Schema::table('press_releases', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'imgix_uuid',
            ]);
        });

        Schema::table('printed_catalogs', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'imgix_uuid',
            ]);
        });
    }

    public function down()
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->string('birth_place')->nullable()->after('birth_date');
            $table->string('death_place')->nullable()->after('death_date');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->text('imgix_uuid')->nullable()->after('copy');
        });

        Schema::table('digital_catalogs', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('web_url');
            $table->text('imgix_uuid')->nullable()->after('copy');
        });

        Schema::table('digital_publication_sections', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('web_url');
        });

        Schema::table('educator_resources', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('web_url');
            $table->text('imgix_uuid')->nullable()->after('copy');
        });

        Schema::table('generic_pages', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('web_url');
            $table->text('imgix_uuid')->nullable()->after('search_tags');
        });

        Schema::table('press_releases', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('web_url');
            $table->text('imgix_uuid')->nullable()->after('copy');
        });

        Schema::table('printed_catalogs', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('web_url');
            $table->text('imgix_uuid')->nullable()->after('copy');
        });
    }
}
