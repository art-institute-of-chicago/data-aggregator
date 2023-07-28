<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropColumn('copyright_notice');
        });
    }

    public function down(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->integer('copyright_notice')->nullable()->after('content');
        });
    }
};
