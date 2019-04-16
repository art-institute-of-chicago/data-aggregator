<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPublishDatesToMoreTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $addPublishDates = function (Blueprint $table) {
            $table->datetime('publish_start_date')->nullable()->after('published');
            $table->datetime('publish_end_date')->nullable()->after('publish_start_date');
        };

        Schema::table('articles', $addPublishDates);
        Schema::table('events', $addPublishDates);
        Schema::table('selections', $addPublishDates);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $dropPublishDates = function (Blueprint $table) {
            $table->dropColumn([
                'publish_start_date',
                'publish_end_date',
            ]);
        };

        Schema::table('articles', $dropPublishDates);
        Schema::table('events', $dropPublishDates);
        Schema::table('selections', $dropPublishDates);
    }
}
