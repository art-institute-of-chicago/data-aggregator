<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExhibitionFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('exhibitions', function (Blueprint $table) {
            $table->string('gallery_display')->nullable()->after('gallery_citi_id');
            $table->string('status')->nullable()->after('gallery_display');
            $table->uuid('asset_lake_guid')->nullable()->after('status');
            $table->date('date_start')->nullable()->after('asset_lake_guid');
            $table->date('date_end')->nullable()->after('date_start');
            $table->date('date_aic_start')->nullable()->after('date_end');
            $table->date('date_aic_end')->nullable()->after('date_aic_start');

        });

        Schema::table('exhibitions', function (Blueprint $table) {
            $table->dropColumn('active');
        });

        Schema::table('exhibitions', function (Blueprint $table) {
            $table->dropColumn('exhibition_dates');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('exhibitions', function (Blueprint $table) {
            $table->dropColumn(['gallery_display',
                                'status',
                                'asset_lake_guid',
                                'date_start',
                                'date_end',
                                'date_aic_start',
                                'date_aic_end']);
        });

        Schema::table('exhibitions', function (Blueprint $table) {
            $table->string('exhibition_dates')->after('gallery_citi_id');
        });

        Schema::table('exhibitions', function (Blueprint $table) {
            $table->boolean('active')->after('exhibition_dates');
        });

    }
}
