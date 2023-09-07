<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('artwork_catalogue', function (Blueprint $table) {
            $table->index('artwork_citi_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('artwork_catalogue', function (Blueprint $table) {
            $table->dropIndex(['artwork_citi_id']);
        });
    }
};
