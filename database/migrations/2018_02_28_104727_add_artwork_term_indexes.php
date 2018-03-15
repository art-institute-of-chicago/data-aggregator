<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddArtworkTermIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('artwork_term', function (Blueprint $table) {

            $table->index('artwork_citi_id');
            $table->index('term_citi_id');
            $table->index('preferred');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('artwork_term', function (Blueprint $table) {

            // Using an array of column names makes it target the generated index names
            $table->dropIndex(['artwork_citi_id']);
            $table->dropIndex(['term_citi_id']);
            $table->dropIndex(['preferred']);

        });

    }
}
