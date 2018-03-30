<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixArtworkTypeIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Leftovers from 2018_02_20_165300_rename_object_type_to_artwork_type
        Schema::table('artwork_types', function (Blueprint $table) {

            $table->dropUnique('object_types_lake_guid_unique');
            $table->dropUnique('object_types_lake_uri_unique');

            $table->unique('lake_guid');
            $table->unique('lake_uri');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('artwork_types', function (Blueprint $table) {

            $table->dropUnique(['lake_guid']);
            $table->dropUnique(['lake_uri']);

            $table->unique('lake_guid', 'object_types_lake_guid_unique');
            $table->unique('lake_uri', 'object_types_lake_uri_unique');

        });

    }
}
