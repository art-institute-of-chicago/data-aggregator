<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('archives', function (Blueprint $table) {
            $table->text('creator')->nullable()->after('title');
            $table->string('date_display')->nullable()->after('creator');
            $table->integer('date_start')->nullable()->after('date_display');
            $table->integer('date_end')->nullable()->after('date_start');
            $table->string('format')->nullable()->after('date_end');
            $table->string('collection_type')->nullable()->after('format');
            $table->json('subjects')->nullable()->after('collection_type');
            $table->string('language')->nullable()->after('subjects');
            $table->text('description')->nullable()->after('language');
        });
    }

    public function down(): void
    {
        Schema::table('archives', function (Blueprint $table) {
            $table->dropColumn([
                'creator',
                'date_display',
                'date_start',
                'date_end',
                'format',
                'collection_type',
                'subjects',
                'language',
                'description',
            ]);
        });
    }
};
