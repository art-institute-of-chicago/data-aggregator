<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Last-known public API representation of each tracked record, used as the baseline for diffs
        Schema::create('record_snapshots', function (Blueprint $table) {
            $table->id();
            $table->string('resource');
            $table->string('record_id');
            $table->char('hash', 32);
            $table->json('data');
            $table->timestamps();

            $table->unique(['resource', 'record_id']);
        });

        // Append-only log of changes to public API fields
        Schema::create('record_changes', function (Blueprint $table) {
            $table->id();
            $table->string('resource');
            $table->string('record_id');
            $table->string('event', 16);
            $table->string('field')->nullable();
            $table->json('old_value')->nullable();
            $table->json('new_value')->nullable();
            $table->timestamp('detected_at');

            $table->index(['resource', 'record_id', 'detected_at']);
            $table->index(['resource', 'detected_at']);
            $table->index('detected_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('record_changes');
        Schema::dropIfExists('record_snapshots');
    }
};
