<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexesToImprovePerformance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artwork_catalogue', function (Blueprint $table) {
            $table->index('artwork_citi_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artwork_catalogue', function (Blueprint $table) {
            $table->dropIndex('v1_artwork_catalogue_artwork_citi_id_index');
        });
    }
}
