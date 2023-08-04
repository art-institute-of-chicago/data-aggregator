<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
        });

        Schema::table('artwork_artist', function (Blueprint $table) {
            $table->integer('agent_role_id')->default(null)->nullable()->change();
            $table->boolean('is_preferred')->default(null)->nullable()->change();
        });

        Schema::table('artwork_category', function (Blueprint $table) {
            $table->string('category_id')->nullable(false)->change();
        });

        Schema::table('artwork_dates', function (Blueprint $table) {
            $table->boolean('is_preferred')->default(null)->change();
        });

        Schema::table('artwork_place', function (Blueprint $table) {
            $table->integer('artwork_place_qualifier_id')->nullable()->change();
            $table->boolean('is_preferred')->nullable()->change();
        });

        Schema::table('artwork_term', function (Blueprint $table) {
            $table->integer('artwork_id')->nullable(false)->change();
            $table->string('term_id')->nullable(false)->change();
            $table->boolean('is_preferred')->default(null)->change();
        });

        Schema::table('assets', function (Blueprint $table) {
            $table->boolean('is_multimedia_resource')->default(null)->change();
            $table->boolean('is_educational_resource')->default(null)->change();
            $table->boolean('is_teacher_resource')->default(null)->change();
        });

        Schema::table('digital_catalogs', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
        });

        Schema::table('educator_resources', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
        });

        Schema::table('event_programs', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
        });

        Schema::table('generic_pages', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
        });

        Schema::table('highlights', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
        });

        Schema::table('mobile_artworks', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
        });

        Schema::table('mobile_sounds', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
            $table->text('web_url')->nullable()->change();
        });

        Schema::table('press_releases', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
        });

        Schema::table('printed_catalogs', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
        });

        Schema::table('publications', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
        });

        Schema::table('sites', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
        });

        Schema::table('tours', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
        });

        Schema::table('web_exhibitions', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->text('title')->nullable(false)->change();
        });

        Schema::table('artwork_artist', function (Blueprint $table) {
            $table->unsignedInteger('agent_role_id')->default(219)->nullable(false)->change();
            $table->boolean('is_preferred')->default(true)->nullable(false)->change();
        });

        Schema::table('artwork_category', function (Blueprint $table) {
            $table->string('category_id')->nullable()->change();
        });

        Schema::table('artwork_dates', function (Blueprint $table) {
            $table->boolean('is_preferred')->default(false)->change();
        });

        Schema::table('artwork_place', function (Blueprint $table) {
            $table->integer('artwork_place_qualifier_id')->nullable(false)->change();
            $table->boolean('is_preferred')->nullable(false)->change();
        });

        Schema::table('artwork_term', function (Blueprint $table) {
            $table->integer('artwork_id')->nullable()->change();
            $table->string('term_id')->nullable()->change();
            $table->boolean('is_preferred')->default(false)->change();
        });

        Schema::table('assets', function (Blueprint $table) {
            $table->boolean('is_multimedia_resource')->default(false)->change();
            $table->boolean('is_educational_resource')->default(false)->change();
            $table->boolean('is_teacher_resource')->default(false)->change();
        });

        Schema::table('digital_catalogs', function (Blueprint $table) {
            $table->text('title')->nullable(false)->change();
        });

        Schema::table('educator_resources', function (Blueprint $table) {
            $table->text('title')->nullable(false)->change();
        });

        Schema::table('event_programs', function (Blueprint $table) {
            $table->text('title')->nullable(false)->change();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->text('title')->nullable(false)->change();
        });

        Schema::table('generic_pages', function (Blueprint $table) {
            $table->text('title')->nullable(false)->change();
        });

        Schema::table('highlights', function (Blueprint $table) {
            $table->text('title')->nullable(false)->change();
        });

        Schema::table('mobile_artworks', function (Blueprint $table) {
            $table->text('title')->nullable(false)->change();
        });

        Schema::table('mobile_sounds', function (Blueprint $table) {
            $table->text('title')->nullable(false)->change();
            $table->text('web_url')->nullable(false)->change();
        });

        Schema::table('press_releases', function (Blueprint $table) {
            $table->text('title')->nullable(false)->change();
        });

        Schema::table('printed_catalogs', function (Blueprint $table) {
            $table->text('title')->nullable(false)->change();
        });

        Schema::table('publications', function (Blueprint $table) {
            $table->text('title')->nullable(false)->change();
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->text('title')->nullable(false)->change();
        });

        Schema::table('sites', function (Blueprint $table) {
            $table->text('title')->nullable(false)->change();
        });

        Schema::table('tours', function (Blueprint $table) {
            $table->text('title')->nullable(false)->change();
        });

        Schema::table('web_exhibitions', function (Blueprint $table) {
            $table->text('title')->nullable(false)->change();
        });
    }
};
