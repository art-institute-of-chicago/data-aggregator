<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->dropColumn('place_of_origin');
        });
    }

    public function down(): void
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->string('place_of_origin')->nullable()->after('copyright_notice');
        });
    }
};
