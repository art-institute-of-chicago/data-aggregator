<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('event_occurrences', function (Blueprint $table) {
            $table->boolean('is_sales_button_hidden')->default(false);
            $table->integer('ticketed_event_id')->unsigned()->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('event_occurrences', function (Blueprint $table) {
            $table->dropColumn('is_sales_button_hidden');
            $table->dropColumn('ticketed_event_id');
        });
    }
};
