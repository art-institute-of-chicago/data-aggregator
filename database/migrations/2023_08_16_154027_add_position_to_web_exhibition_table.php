<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('web_exhibitions', function (Blueprint $table) {
            $table->integer('position')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('web_exhibitions', function (Blueprint $table) {
            $table->dropColumn('position');
        });
    }
};
