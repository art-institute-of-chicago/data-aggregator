<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('digital_catalogs', function (Blueprint $table) {
            $table->dropColumn([
                'listing_description',
                'short_description',
            ]);
        });

        Schema::table('digital_publication_sections', function (Blueprint $table) {
            $table->dropColumn([
                'listing_description',
                'heading',
            ]);
        });

        Schema::table('educator_resources', function (Blueprint $table) {
            $table->dropColumn([
                'listing_description',
                'short_description',
            ]);
        });

        Schema::table('generic_pages', function (Blueprint $table) {
            $table->dropColumn([
                'listing_description',
                'short_description',
            ]);
        });

        Schema::table('highlights', function (Blueprint $table) {
            $table->dropColumn([
                'short_copy',
            ]);
        });

        Schema::table('press_releases', function (Blueprint $table) {
            $table->dropColumn([
                'listing_description',
                'short_description',
            ]);
        });

        Schema::table('printed_catalogs', function (Blueprint $table) {
            $table->dropColumn([
                'listing_description',
                'short_description',
            ]);
        });

        Schema::table('web_exhibitions', function (Blueprint $table) {
            $table->dropColumn([
                'header_copy',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('digital_catalogs', function (Blueprint $table) {
            $table->text('listing_description')->nullable()->after('slug');
            $table->text('short_description')->nullable()->after('listing_description');
        });

        Schema::table('digital_publication_sections', function (Blueprint $table) {
            $table->text('listing_description')->nullable()->after('slug');
            $table->text('heading')->nullable()->after('type');
        });

        Schema::table('educator_resources', function (Blueprint $table) {
            $table->text('listing_description')->nullable()->after('slug');
            $table->text('short_description')->nullable()->after('listing_description');
        });

        Schema::table('generic_pages', function (Blueprint $table) {
            $table->text('listing_description')->nullable()->after('slug');
            $table->text('short_description')->nullable()->after('listing_description');
        });

        Schema::table('highlights', function (Blueprint $table) {
            $table->text('short_copy')->nullable()->after('title');
        });

        Schema::table('press_releases', function (Blueprint $table) {
            $table->text('listing_description')->nullable()->after('slug');
            $table->text('short_description')->nullable()->after('listing_description');
        });

        Schema::table('printed_catalogs', function (Blueprint $table) {
            $table->text('listing_description')->nullable()->after('slug');
            $table->text('short_description')->nullable()->after('listing_description');
        });

        Schema::table('web_exhibitions', function (Blueprint $table) {
            $table->text('header_copy')->nullable()->after('title');
        });
    }
};
