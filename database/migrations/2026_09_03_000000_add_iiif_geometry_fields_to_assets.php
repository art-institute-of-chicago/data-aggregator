<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->unsignedSmallInteger('tile_width')->nullable()->after('height');
            $table->unsignedSmallInteger('tile_height')->nullable()->after('tile_width');
            $table->json('scale_factors')->nullable()->after('tile_height');
            $table->timestamp('iiif_synced_at')->nullable()->after('scale_factors');
        });
    }

    public function down(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropColumn(['tile_width', 'tile_height', 'scale_factors', 'iiif_synced_at']);
        });
    }
};
