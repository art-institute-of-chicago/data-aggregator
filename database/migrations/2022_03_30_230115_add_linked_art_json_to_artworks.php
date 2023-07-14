<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->json('linked_art_json')->nullable()->after('provenance');
        });
    }

    public function down()
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->dropColumn('linked_art_json');
        });
    }
};
