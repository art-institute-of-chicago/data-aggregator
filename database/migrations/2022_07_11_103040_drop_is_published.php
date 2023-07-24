<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        foreach ([
            'articles',
            'assets',
            'digital_catalogs',
            'digital_publication_sections',
            'educator_resources',
            'events',
            'experiences',
            'generic_pages',
            'highlights',
            'interactive_features',
            'issue_articles',
            'issues',
            'press_releases',
            'printed_catalogs',
            'web_exhibitions',
        ] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn(['is_published']);
            });
        }
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->boolean('is_published')->after('imgix_uuid');
        });

        Schema::table('assets', function (Blueprint $table) {
            $table->string('is_published')->nullable()->after('content');
        });

        Schema::table('digital_catalogs', function (Blueprint $table) {
            $table->boolean('is_published')->nullable()->after('short_description');
        });

        Schema::table('digital_publication_sections', function (Blueprint $table) {
            $table->boolean('is_published')->nullable()->after('listing_description');
        });

        Schema::table('educator_resources', function (Blueprint $table) {
            $table->boolean('is_published')->nullable()->after('short_description');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->boolean('is_published')->default(false)->after('image_url');
        });

        Schema::table('experiences', function (Blueprint $table) {
            $table->boolean('is_published')->default(false)->after('kiosk_only');
        });

        Schema::table('generic_pages', function (Blueprint $table) {
            $table->boolean('is_published')->nullable()->after('short_description');
        });

        Schema::table('highlights', function (Blueprint $table) {
            $table->boolean('is_published')->after('copy');
        });

        Schema::table('interactive_features', function (Blueprint $table) {
            $table->boolean('is_published')->default(false)->after('archived');
        });

        Schema::table('issue_articles', function (Blueprint $table) {
            $table->boolean('is_published')->after('title');
        });

        Schema::table('issues', function (Blueprint $table) {
            $table->boolean('is_published')->after('title');
        });

        Schema::table('press_releases', function (Blueprint $table) {
            $table->boolean('is_published')->nullable()->after('short_description');
        });

        Schema::table('printed_catalogs', function (Blueprint $table) {
            $table->boolean('is_published')->nullable()->after('short_description');
        });

        Schema::table('web_exhibitions', function (Blueprint $table) {
            $table->boolean('is_published')->after('date_display');
        });
    }
};
