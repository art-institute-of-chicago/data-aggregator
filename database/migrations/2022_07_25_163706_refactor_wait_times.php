<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('wait_times', function (Blueprint $table) {
            $table->dropColumn([
                'duration',
                'units',
            ]);
        });

        Schema::table('wait_times', function (Blueprint $table) {
            $table->renameColumn('display', 'wait_display');
        });
    }

    public function down(): void
    {
        Schema::table('wait_times', function (Blueprint $table) {
            $table->integer('duration')->nullable()->after('title');
            $table->string('units')->nullable()->after('duration');

            $table->renameColumn('wait_display', 'display');
        });
    }
};
