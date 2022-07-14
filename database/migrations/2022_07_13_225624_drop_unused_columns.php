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

        Schema::table('artwork_dates', function (Blueprint $table) {
            $table->dropColumn([
                'title',
            ]);
        });

        Schema::table('artworks', function (Blueprint $table) {
            $table->dropColumn([
                'collection_status',
            ]);
        });

        Schema::table('assets', function (Blueprint $table) {
            $table->dropColumn([
                'description',
                'content_modified_at',
                'source_indexed_at',
            ]);
        });

        Schema::table('digital_catalogs', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'listing_description',
                'short_description',
                'imgix_uuid',
            ]);
        });

        Schema::table('digital_publication_sections', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'listing_description',
            ]);
        });

        Schema::table('educator_resources', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'listing_description',
                'short_description',
                'imgix_uuid',
            ]);
        });

        Schema::table('generic_pages', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'listing_description',
                'short_description',
                'imgix_uuid',
            ]);
        });

        Schema::table('press_releases', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'listing_description',
                'short_description',
                'imgix_uuid',
            ]);
        });

        Schema::table('printed_catalogs', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'listing_description',
                'short_description',
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

        Schema::table('artwork_dates', function (Blueprint $table) {
            $table->string('title')->nullable()->after('id');
        });

        Schema::table('artworks', function (Blueprint $table) {
            $table->string('collection_status')->nullable()->after('copyright_notice');
        });

        Schema::table('assets', function (Blueprint $table) {
            $table->text('description')->nullable()->after('title');
            $table->timestamp('content_modified_at')->nullable()->after('content_e_tag');
            $table->timestamp('source_indexed_at')->nullable()->after('source_updated_at');
        });

        Schema::table('digital_catalogs', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('web_url');
            $table->text('listing_description')->nullable()->after('slug');
            $table->text('short_description')->nullable()->after('listing_description');
            $table->text('imgix_uuid')->nullable()->after('copy');
        });

        Schema::table('digital_publication_sections', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('web_url');
            $table->text('listing_description')->nullable()->after('slug');
        });

        Schema::table('educator_resources', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('web_url');
            $table->text('listing_description')->nullable()->after('slug');
            $table->text('short_description')->nullable()->after('listing_description');
            $table->text('imgix_uuid')->nullable()->after('copy');
        });

        Schema::table('generic_pages', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('web_url');
            $table->text('listing_description')->nullable()->after('slug');
            $table->text('short_description')->nullable()->after('listing_description');
            $table->text('imgix_uuid')->nullable()->after('search_tags');
        });

        Schema::table('press_releases', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('web_url');
            $table->text('listing_description')->nullable()->after('slug');
            $table->text('short_description')->nullable()->after('listing_description');
            $table->text('imgix_uuid')->nullable()->after('copy');
        });

        Schema::table('printed_catalogs', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('web_url');
            $table->text('listing_description')->nullable()->after('slug');
            $table->text('short_description')->nullable()->after('listing_description');
            $table->text('imgix_uuid')->nullable()->after('copy');
        });
    }
}
