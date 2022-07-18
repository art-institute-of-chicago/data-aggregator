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
    }
}
