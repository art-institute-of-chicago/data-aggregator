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
        Schema::table('event_email_series', function (Blueprint $table) {
            $table->renameColumn('sustaining_fellow_copy', 'luminary_copy');
        });

        Schema::table('event_email_series', function (Blueprint $table) {
            $table->renameColumn('send_sustaining_fellow_test', 'send_luminary_test');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('event_email_series', function (Blueprint $table) {
            $table->renameColumn('luminary_copy', 'sustaining_fellow_copy');
        });

        Schema::table('event_email_series', function (Blueprint $table) {
            $table->renameColumn('send_luminary_test', 'send_sustaining_fellow_test');
        });
    }
};
