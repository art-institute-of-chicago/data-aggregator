<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->dropColumn('licensing_restricted');
        });
    }

    public function down(): void
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->boolean('licensing_restricted')->nullable()->after('death_place');
        });
    }
};
