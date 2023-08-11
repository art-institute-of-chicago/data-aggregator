<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('digital_publication_sections', function (Blueprint $table) {
            $table->longText('copy')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('digital_publication_sections', function (Blueprint $table) {
            $table->text('copy')->nullable()->change();
        });
    }
};
