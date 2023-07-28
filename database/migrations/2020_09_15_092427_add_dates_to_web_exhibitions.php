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
        Schema::table('web_exhibitions', function (Blueprint $table) {
            $table->date('public_start_at')->nullable()->after('exhibition_message');
            $table->date('public_end_at')->nullable()->after('public_start_at');
            $table->text('date_display')->nullable()->after('public_end_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('web_exhibitions', function (Blueprint $table) {
            $table->dropColumn([
                'public_start_at',
                'public_end_at',
                'date_display',
            ]);
        });
    }
};
