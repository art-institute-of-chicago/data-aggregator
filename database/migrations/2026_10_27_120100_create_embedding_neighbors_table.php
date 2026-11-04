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
