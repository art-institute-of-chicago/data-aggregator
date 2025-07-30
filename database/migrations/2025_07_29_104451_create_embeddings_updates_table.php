<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function __construct()
    {
        $this->connection = 'vectors';
    }

    public function up(): void
    {
        Schema::create('embedding_updates', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at');
            $table->string('embedding_type');
            $table->string('model_id');
            $table->string('model_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('embedding_updates');
    }
};
