<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRightFlagsToArtworks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('artworks', function (Blueprint $table) {
            $table->boolean('is_zoomable')->nullable()->after('is_public_domain');
            $table->integer('max_zoom_window_size')->nullable()->after('is_zoomable');
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
            $table->dropColumn(['is_zoomable',
                                'max_zoom_window_size']);
        });

    }
}
