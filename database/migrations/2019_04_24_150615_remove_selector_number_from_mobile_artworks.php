<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveSelectorNumberFromMobileArtworks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mobile_artworks', function (Blueprint $table) {
            $table->dropColumn('selector_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mobile_artworks', function (Blueprint $table) {
            $table->integer('selector_number')->nullable()->after('longitude');
        });
    }
}
