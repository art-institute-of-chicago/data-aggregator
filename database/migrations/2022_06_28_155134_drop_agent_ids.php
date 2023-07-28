<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    private $tables = [
        'agents' => 'updated_at',
        'articles' => 'updated_at',
    ];

    public function up(): void
    {
        foreach ($this->tables as $tableName => $afterColumn) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn('agent_ids');
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $tableName => $afterColumn) {
            Schema::table($tableName, function (Blueprint $table) use ($afterColumn) {
                $table->json('agent_ids')->nullable()->after($afterColumn);
            });
        }
    }
};
