<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('is_unlisted');
        });

        Schema::table('experiences', function (Blueprint $table) {
            $table->dropColumn('is_unlisted');
        });

        Schema::table('highlights', function (Blueprint $table) {
            $table->dropColumn('is_unlisted');
        });

        Schema::table('press_releases', function (Blueprint $table) {
            $table->dropColumn('is_unlisted');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->boolean('is_unlisted')->default(false)->after('updated_at');
        });

        Schema::table('experiences', function (Blueprint $table) {
            $table->boolean('is_unlisted')->default(false)->after('updated_at');
        });

        Schema::table('highlights', function (Blueprint $table) {
            $table->boolean('is_unlisted')->default(false)->after('updated_at');
        });

        Schema::table('press_releases', function (Blueprint $table) {
            $table->boolean('is_unlisted')->default(false)->after('updated_at');
        });
    }
};
