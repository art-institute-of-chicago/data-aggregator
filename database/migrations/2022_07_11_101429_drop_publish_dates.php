<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['publish_start_date', 'publish_end_date']);
        });

        Schema::table('digital_catalogs', function (Blueprint $table) {
            $table->dropColumn(['publish_start_date', 'publish_end_date']);
        });

        Schema::table('digital_publication_sections', function (Blueprint $table) {
            $table->dropColumn(['publish_start_date']);
        });

        Schema::table('educator_resources', function (Blueprint $table) {
            $table->dropColumn(['publish_start_date', 'publish_end_date']);
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['publish_start_date', 'publish_end_date']);
        });

        Schema::table('generic_pages', function (Blueprint $table) {
            $table->dropColumn(['publish_start_date', 'publish_end_date']);
        });

        Schema::table('highlights', function (Blueprint $table) {
            $table->dropColumn(['publish_start_date', 'publish_end_date']);
        });

        Schema::table('issue_articles', function (Blueprint $table) {
            $table->dropColumn(['publish_start_date']);
        });

        Schema::table('issues', function (Blueprint $table) {
            $table->dropColumn(['publish_start_date']);
        });

        Schema::table('press_releases', function (Blueprint $table) {
            $table->dropColumn(['publish_start_date', 'publish_end_date']);
        });

        Schema::table('printed_catalogs', function (Blueprint $table) {
            $table->dropColumn(['publish_start_date', 'publish_end_date']);
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dateTime('publish_start_date')->nullable()->after('is_published');
            $table->dateTime('publish_end_date')->nullable()->after('publish_start_date');
        });

        Schema::table('digital_catalogs', function (Blueprint $table) {
            $table->dateTime('publish_start_date')->nullable()->after('is_published');
            $table->dateTime('publish_end_date')->nullable()->after('publish_start_date');
        });

        Schema::table('digital_publication_sections', function (Blueprint $table) {
            $table->dateTime('publish_start_date')->nullable()->after('is_published');
        });

        Schema::table('educator_resources', function (Blueprint $table) {
            $table->dateTime('publish_start_date')->nullable()->after('is_published');
            $table->dateTime('publish_end_date')->nullable()->after('publish_start_date');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dateTime('publish_start_date')->nullable()->after('is_published');
            $table->dateTime('publish_end_date')->nullable()->after('publish_start_date');
        });

        Schema::table('generic_pages', function (Blueprint $table) {
            $table->dateTime('publish_start_date')->nullable()->after('is_published');
            $table->dateTime('publish_end_date')->nullable()->after('publish_start_date');
        });

        Schema::table('highlights', function (Blueprint $table) {
            $table->dateTime('publish_start_date')->nullable()->after('is_published');
            $table->dateTime('publish_end_date')->nullable()->after('publish_start_date');
        });

        Schema::table('issue_articles', function (Blueprint $table) {
            $table->dateTime('publish_start_date')->nullable()->after('is_published');
        });

        Schema::table('issues', function (Blueprint $table) {
            $table->dateTime('publish_start_date')->nullable()->after('is_published');
        });

        Schema::table('press_releases', function (Blueprint $table) {
            $table->dateTime('publish_start_date')->nullable()->after('is_published');
            $table->dateTime('publish_end_date')->nullable()->after('publish_start_date');
        });

        Schema::table('printed_catalogs', function (Blueprint $table) {
            $table->dateTime('publish_start_date')->nullable()->after('is_published');
            $table->dateTime('publish_end_date')->nullable()->after('publish_start_date');
        });
    }
};
