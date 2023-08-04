<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('issues', function (Blueprint $table) {
            $table->text('cite_as')->nullable()->change();
        });

        Schema::table('issue_articles', function (Blueprint $table) {
            $table->text('cite_as')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('issues', function (Blueprint $table) {
            $table->string('cite_as')->nullable()->change();
        });

        Schema::table('issue_articles', function (Blueprint $table) {
            $table->string('cite_as')->nullable()->change();
        });
    }
};
