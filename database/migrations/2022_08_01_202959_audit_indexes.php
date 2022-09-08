<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AuditIndexes extends Migration
{
    public function up()
    {
        Schema::table('agents', function (Blueprint $table) {
            // API-341: We don't need this b/c we don't show agent type
            // in agent API anymore, so we don't need to touch agents
            // when an agent type updates.
            $table->dropIndex(['agent_type_id']);
        });

        Schema::table('artwork_artist', function (Blueprint $table) {
            $table->dropIndex(['agent_role_id']);
            $table->dropIndex(['is_preferred']);
        });

        // API-339: Do this filtering in API output.
        Schema::table('artwork_asset', function (Blueprint $table) {
            $table->dropIndex(['is_doc']);
            $table->dropIndex(['is_preferred']);
        });

        Schema::table('artwork_dates', function (Blueprint $table) {
            $table->dropIndex(['is_preferred']);
        });

        Schema::table('artwork_place', function (Blueprint $table) {
            $table->dropIndex(['artwork_place_qualifier_id']);
            $table->dropIndex(['is_preferred']);
        });

        Schema::table('artwork_term', function (Blueprint $table) {
            $table->dropIndex(['is_preferred']);
            $table->dropIndex(['artwork_id', 'term_id']);
        });

        Schema::table('artworks', function (Blueprint $table) {
            $table->dropIndex(['pageviews']);
            // I feel like artwork types are very static, and it's not
            // worth the performance impact to anticipate renaming.
            $table->dropIndex(['artwork_type_id']);
            // However, galleries get closed/opened all the time, and
            // renamed sometimes. Let's keep the `gallery_id` index.
            $table->dropIndex(['pageviews_recent']);
        });

        Schema::table('assets', function (Blueprint $table) {
            $table->dropIndex(['is_multimedia_resource']);
            $table->dropIndex(['is_educational_resource']);
            $table->dropIndex(['is_teacher_resource']);
        });

        // API-339: Do this filtering in API output, too.
        Schema::table('exhibition_asset', function (Blueprint $table) {
            $table->dropIndex(['is_doc']);
            $table->dropIndex(['is_preferred']);
        });

        // Galleries currently do not touch exhibitions; however, it makes
        // sense that they should... but *only* when their titles change,
        // which should be rare... unless the closed status of an exhibition
        // is related to its gallery being closed? In which case it's similar
        // to artworks. However, I think CITI handles that logic for us.
        // Anyway, I'll keep `gallery_id` in `exhibitions` for now.

        // ...index did not get renamed along with table?
        Schema::table('highlights', function (Blueprint $table) {
            $prefix = DB::connection()->getTablePrefix();
            $index = $prefix . 'selections_updated_at_index';

            if ($table->getDoctrineTable()->hasIndex($index)) {
                $table->dropIndex($prefix . 'selections_updated_at_index');
            }
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->dropIndex(['accession']);
        });

        Schema::table('tours', function (Blueprint $table) {
            $table->dropIndex(['intro_id']);
        });

        Schema::table('web_exhibitions', function (Blueprint $table) {
            $table->index(['datahub_id']);
        });
    }

    public function down()
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->index(['agent_type_id']);
        });

        Schema::table('artwork_artist', function (Blueprint $table) {
            $table->index(['agent_role_id']);
            $table->index(['is_preferred']);
        });

        Schema::table('artwork_asset', function (Blueprint $table) {
            $table->index(['is_doc']);
            $table->index(['is_preferred']);
        });

        Schema::table('artwork_dates', function (Blueprint $table) {
            $table->index(['is_preferred']);
        });

        Schema::table('artwork_place', function (Blueprint $table) {
            $table->index(['artwork_place_qualifier_id']);
            $table->index(['is_preferred']);
        });

        Schema::table('artwork_term', function (Blueprint $table) {
            $table->index(['is_preferred']);
            $table->index(['artwork_id', 'term_id']);
        });

        Schema::table('artworks', function (Blueprint $table) {
            $table->index(['pageviews']);
            $table->index(['artwork_type_id']);
            $table->index(['pageviews_recent']);
        });

        Schema::table('assets', function (Blueprint $table) {
            $table->index(['is_multimedia_resource']);
            $table->index(['is_educational_resource']);
            $table->index(['is_teacher_resource']);
        });

        Schema::table('exhibition_asset', function (Blueprint $table) {
            $table->index(['is_doc']);
            $table->index(['is_preferred']);
        });

        Schema::table('highlights', function (Blueprint $table) {
            $prefix = DB::connection()->getTablePrefix();

            $table->index(['updated_at'], $prefix . 'selections_updated_at_index');
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->index(['accession']);
        });

        Schema::table('tours', function (Blueprint $table) {
            $table->index(['intro_id']);
        });

        Schema::table('web_exhibitions', function (Blueprint $table) {
            $table->dropIndex(['datahub_id']);
        });
    }
}
