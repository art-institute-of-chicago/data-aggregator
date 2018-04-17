<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveSourceDatesFromArtworkDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('artwork_dates', function(Blueprint $table) {
            $table->dropColumn('source_created_at');
        });
        Schema::table('artwork_dates', function(Blueprint $table) {
            $table->dropColumn('source_modified_at');
        });
        Schema::table('artwork_dates', function(Blueprint $table) {
            $table->dropColumn('source_indexed_at');
        });
        Schema::table('artwork_dates', function(Blueprint $table) {
            $table->dropColumn('citi_created_at');
        });
        Schema::table('artwork_dates', function(Blueprint $table) {
            $table->dropColumn('citi_modified_at');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('artwork_dates', function(Blueprint $table) {
            $table->timestamp('source_created_at')->nullable()->after('preferred');
            $table->timestamp('source_modified_at')->nullable()->after('source_created_at');
            $table->timestamp('source_indexed_at')->nullable()->after('source_modified_at');
            $table->timestamp('citi_created_at')->nullable()->after('source_indexed_at');
            $table->timestamp('citi_modified_at')->nullable()->after('citi_created_at');
        });

    }
}
