<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameObjectTypeToArtworkType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::rename('object_types', 'artwork_types');

        Schema::table('artworks', function (Blueprint $table) {
            $table->renameColumn('object_type_citi_id', 'artwork_type_citi_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::rename('artwork_types', 'object_types');

        Schema::table('artworks', function (Blueprint $table) {
            $table->renameColumn('artwork_type_citi_id', 'object_type_citi_id');
        });

    }
}
