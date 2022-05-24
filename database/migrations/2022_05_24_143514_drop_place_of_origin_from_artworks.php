<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPlaceOfOriginFromArtworks extends Migration
{
    public function up()
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->dropColumn('place_of_origin');
        });
    }

    public function down()
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->string('place_of_origin')->nullable()->after('copyright_notice');
        });
    }
}
