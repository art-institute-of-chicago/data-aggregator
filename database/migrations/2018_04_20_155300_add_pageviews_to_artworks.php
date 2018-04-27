<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPageviewsToArtworks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('artworks', function(Blueprint $table) {

            $table->integer('pageviews')->nullable()->index()->after('main_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('artworks', function (Blueprint $table) {

            $table->dropColumn('pageviews');

        });

    }
}
