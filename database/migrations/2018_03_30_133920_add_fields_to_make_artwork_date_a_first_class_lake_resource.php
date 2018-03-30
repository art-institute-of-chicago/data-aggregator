<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToMakeArtworkDateAFirstClassLakeResource extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('artwork_dates', function(Blueprint $table) {
            $table->dropColumn('id');
        });
        Schema::table('artwork_dates', function(Blueprint $table) {
            $table->integer('citi_id')->primary()->default(0)->first();
            $table->uuid('lake_guid')->unique()->nullable()->index()->after('citi_id');
            $table->string('title')->nullable()->after('lake_guid');
            $table->string('lake_uri')->unique()->nullable()->after('title');

            $table->timestamp('source_created_at')->nullable()->after('preferred');
            $table->timestamp('source_modified_at')->nullable()->after('source_created_at');
            $table->timestamp('source_indexed_at')->nullable()->after('source_modified_at');
            $table->timestamp('citi_created_at')->nullable()->after('source_indexed_at');
            $table->timestamp('citi_modified_at')->nullable()->after('citi_created_at');
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
            $table->dropColumn('citi_id');
            $table->dropColumn('lake_guid');
            $table->dropColumn('title');
            $table->dropColumn('lake_uri');

            $table->dropColumn('source_created_at');
            $table->dropColumn('source_modified_at');
            $table->dropColumn('source_indexed_at');
            $table->dropColumn('citi_created_at');
            $table->dropColumn('citi_modified_at');
        });
        Schema::table('artwork_dates', function(Blueprint $table) {
            $table->integer('id')->increments();
        });

    }
}
