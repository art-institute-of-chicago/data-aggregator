<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropMiscColumns extends Migration
{
    public function up()
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->dropColumn([
                'birth_place',
                'death_place',
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

        Schema::table('digital_publication_sections', function (Blueprint $table) {
            $table->dropColumn([
                'type',
            ]);
        });

        Schema::table('exhibitions', function (Blueprint $table) {
            $table->dropColumn([
                'description',
                'type',
                'place_display',
                'department_display',
            ]);
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn([
                'type',
            ]);
        });

        Schema::table('places', function (Blueprint $table) {
            $table->dropColumn([
                'type',
            ]);
        });

        Schema::table('publications', function (Blueprint $table) {
            $table->dropColumn([
                'site',
            ]);
        });

        Schema::table('web_artists', function (Blueprint $table) {
            $table->dropColumn([
                'also_known_as',
            ]);
        });

        Schema::table('web_exhibitions', function (Blueprint $table) {
            $table->dropColumn([
                'content',
                'exhibition_message',
                'date_display',
            ]);
        });
    }

    public function down()
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->string('birth_place')->nullable()->after('birth_date');
            $table->string('death_place')->nullable()->after('death_date');
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

        Schema::table('digital_publication_sections', function (Blueprint $table) {
            $table->string('type')->nullable()->after('copy');
        });

        Schema::table('exhibitions', function (Blueprint $table) {
            $table->text('description')->nullable()->after('title');
            $table->string('type')->nullable()->after('description');
            $table->string('place_display')->nullable()->after('place_id');
            $table->string('department_display')->nullable()->after('place_display');
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->string('type')->nullable()->after('longitude');
        });

        Schema::table('places', function (Blueprint $table) {
            $table->string('type')->nullable()->after('updated_at');
        });

        Schema::table('publications', function (Blueprint $table) {
            $table->text('site')->nullable()->after('title');
        });

        Schema::table('web_artists', function (Blueprint $table) {
            $table->boolean('also_known_as')->nullable()->after('title');
        });

        Schema::table('web_exhibitions', function (Blueprint $table) {
            $table->json('content')->nullable()->after('list_description');
            $table->text('exhibition_message')->nullable()->after('datahub_id');
            $table->text('date_display')->nullable()->after('public_end_at');
        });
    }
}
