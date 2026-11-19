<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('artworks', fn (Blueprint $table) => $table->json('pageviews_by_month')->nullable()->after('pageviews_recent'));
    }

    public function down(): void
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->dropColumn('pageviews_by_month');
        });
    }
};
