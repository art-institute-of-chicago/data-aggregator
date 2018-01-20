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
            $table->removeColumn('active');
            $table->removeColumn('exhibition_dates');
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
            $table->removeColumn('gallery_display');
            $table->removeColumn('status');
            $table->removeColumn('asset_lake_guid');
            $table->removeColumn('date_start');
            $table->removeColumn('date_end');
            $table->removeColumn('date_aic_start');
            $table->removeColumn('date_aic_end');
        });

        Schema::table('exhibitions', function (Blueprint $table) {
            $table->string('exhibition_dates')->after('gallery_citi_id');
            $table->boolean('active')->after('exhibition_dates');
        });

    }
}
