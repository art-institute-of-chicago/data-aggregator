<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDimensionsDetailColumnToArtworksTable extends Migration
{
    public function up()
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->json('dimensions_detail')->nullable();
        });
    }

    public function down()
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->dropColumn('dimensions_detail');
        });
    }
}
