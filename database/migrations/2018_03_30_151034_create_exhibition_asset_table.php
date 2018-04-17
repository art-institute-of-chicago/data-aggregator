<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExhibitionAssetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exhibition_asset', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('exhibition_citi_id')->signed()->index();
            $table->uuid('asset_lake_guid')->index();
            $table->boolean('is_doc')->default(false)->index();
            $table->boolean('preferred')->index();

        });

        Schema::table('exhibitions', function (Blueprint $table) {

            $table->dropColumn('asset_lake_guid');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exhibition_asset');


        Schema::table('exhibitions', function (Blueprint $table) {

            $table->uuid('asset_lake_guid')->nullable()->after('status');

        });

    }
}
