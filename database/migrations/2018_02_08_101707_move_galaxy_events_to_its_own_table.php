<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveGalaxyEventsToItsOwnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Move data and tables as they are
        DB::statement('CREATE TABLE ticketed_events AS SELECT * FROM events WHERE is_ticketed=1;');
        DB::statement('CREATE TABLE legacy_events AS SELECT * FROM events WHERE is_ticketed!=1;');

        Schema::dropIfExists('events');

        // Drop unused fields from ticketed_events
        Schema::table('ticketed_events', function (Blueprint $table) {
            $table->dropColumn('is_ticketed');
        });

        Schema::table('ticketed_events', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        Schema::table('ticketed_events', function (Blueprint $table) {
            $table->dropColumn('description');
        });

        Schema::table('ticketed_events', function (Blueprint $table) {
            $table->dropColumn('short_description');
        });


        // Drop unused fields from legacy_events
        Schema::table('legacy_events', function (Blueprint $table) {
            $table->dropColumn('is_ticketed');
        });

        Schema::table('legacy_events', function (Blueprint $table) {
            $table->dropColumn('resource_id');
        });

        Schema::table('legacy_events', function (Blueprint $table) {
            $table->dropColumn('is_after_hours');
        });

        Schema::table('legacy_events', function (Blueprint $table) {
            $table->dropColumn('is_private_event');
        });

        Schema::table('legacy_events', function (Blueprint $table) {
            $table->dropColumn('available');
        });

        Schema::table('legacy_events', function (Blueprint $table) {
            $table->dropColumn('total_capacity');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        // Merge the two tables back together
        DB::statement('CREATE TABLE events LIKE legacy_events;');
        Schema::table('events', function (Blueprint $table) {
            $table->boolean('is_ticketed')->after('short_description');
            $table->integer('resource_id')->nullable()->after('is_ticketed');
            $table->boolean('is_after_hours')->nullable()->after('resource_id');
            $table->boolean('is_private_event')->nullable()->after('is_after_hours');
            $table->integer('available')->nullable()->after('is_private_event');
            $table->integer('total_capacity')->nullable()->after('available');
        });
        DB::statement('INSERT INTO events (membership_id, '
                       .'title, '
                       .'type, '
                       .'start_at, '
                       .'end_at, '
                       .'resource_title, '
                       .'is_admission_required, '
                       .'image_url, '
                       .'description, '
                       .'short_description, '
                       .'source_created_at, '
                       .'source_modified_at, '
                       .'created_at, '
                       .'updated_at, '
                       .'is_ticketed) '
                      .'SELECT membership_id, '
                        .'title, '
                        .'type, '
                        .'start_at, '
                        .'end_at, '
                        .'resource_title, '
                        .'is_admission_required, '
                        .'image_url, '
                        .'description, '
                        .'short_description, '
                        .'source_created_at, '
                        .'source_modified_at, '
                        .'created_at, '
                        .'updated_at, '
                        .'1 '
                      .'FROM ticketed_events;');
        DB::statement('INSERT INTO events (membership_id, '
                       .'title, '
                       .'type, '
                       .'start_at, '
                       .'end_at, '
                       .'resource_title, '
                       .'is_admission_required, '
                       .'image_url, '
                       .'description, '
                       .'short_description, '
                       .'source_created_at, '
                       .'source_modified_at, '
                       .'created_at, '
                       .'updated_at, '
                       .'is_ticketed) '
                      .'SELECT '
                        .'title, '
                        .'type, '
                        .'start_at, '
                        .'end_at, '
                        .'resource_title, '
                        .'is_admission_required, '
                        .'image_url, '
                        .'description, '
                        .'short_description, '
                        .'source_created_at, '
                        .'source_modified_at, '
                        .'created_at, '
                        .'updated_at, '
                        .'0 '
                      .'FROM legacy_events;');

        // Drop new tables
        Schema::dropIfExists('ticketed_events');
        Schema::dropIfExists('legacy_events');

    }
}
