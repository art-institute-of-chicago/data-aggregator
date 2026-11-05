<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function __construct()
    {
        $this->connection = 'vectors';
    }

    /**
     * Same key as the index migration, so concurrent deploys serialize.
     */
    protected const ADVISORY_LOCK_KEY = 859015398;

    public function up(): void
    {
        DB::connection('vectors')->select('SELECT pg_advisory_xact_lock(?)', [self::ADVISORY_LOCK_KEY]);

        // Two sessions creating the same table fail the same way two sessions
        // creating the same index do, so take the same lock first.
        if (Schema::connection('vectors')->hasTable('embedding_neighbors')) {
            return;
        }

        // Materialized nearest neighbors, filled by `ai:precompute-neighbors`.
        // Serving a similarity read becomes a btree lookup on
        // (embedding_type, model_name, model_id, rank) instead of an HNSW scan.
        Schema::connection('vectors')->create('embedding_neighbors', function (Blueprint $table) {
            $table->id();
            $table->string('embedding_type', 8); // text | image
            $table->string('model_name');
            $table->integer('model_id');
            $table->unsignedSmallInteger('rank');
            $table->unsignedBigInteger('neighbor_id'); // id in text_embeddings / image_embeddings
            $table->string('neighbor_model_name');
            $table->integer('neighbor_model_id');
            $table->double('distance');
            $table->timestamp('computed_at');

            $table->unique(['embedding_type', 'model_name', 'model_id', 'rank'], 'embedding_neighbors_source_rank_uq');
            $table->index(['embedding_type', 'model_name', 'neighbor_model_id'], 'embedding_neighbors_neighbor_idx');
        });
    }

    public function down(): void
    {
        Schema::connection('vectors')->dropIfExists('embedding_neighbors');
    }
};
