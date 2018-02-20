<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLegacyImageFieldsToExhibition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('exhibitions', function (Blueprint $table) {
            $table->string('legacy_image_desktop')->nullable()->after('asset_lake_guid');
            $table->string('legacy_image_mobile')->nullable()->after('legacy_image_desktop');
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
            $table->dropColumn('legacy_image_desktop');
            $table->dropColumn('legacy_image_mobile');
        });

    }
}
