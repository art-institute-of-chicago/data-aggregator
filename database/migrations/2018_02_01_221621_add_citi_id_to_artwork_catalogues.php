<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCitiIdToArtworkCatalogues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('artwork_catalogue', function (Blueprint $table) {
            $table->integer('citi_id')->nullable()->first();
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
            $table->dropColumn('citi_id');
        });

    }
}
