<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    private $tables = [
        'assets' => 'content_modified_at',
        'event_occurrences' => 'button_caption',
        'products' => 'max_current_price',
        'ticketed_event_types' => 'description',
        'ticketed_events' => 'total_capacity',
    ];

    public function up(): void
    {
        foreach ($this->tables as $tableName => $afterColumn) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn('source_created_at');
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $tableName => $afterColumn) {
            Schema::table($tableName, function (Blueprint $table) use ($afterColumn) {
                $table->timestamp('source_created_at')->nullable()->after($afterColumn);
            });
        }
    }
};
