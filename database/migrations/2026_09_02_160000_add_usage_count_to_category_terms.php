<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('category_terms', function (Blueprint $table) {
            $table->unsignedInteger('usage_count')->default(0)->index();
        });
    }

    public function down(): void
    {
        Schema::table('category_terms', function (Blueprint $table) {
            $table->dropIndex(['usage_count']);
            $table->dropColumn('usage_count');
        });
    }
};
