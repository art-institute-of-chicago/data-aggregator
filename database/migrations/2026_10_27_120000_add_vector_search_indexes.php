<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class () extends Migration {
    public function __construct()
    {
        $this->connection = 'vectors';
    }

    public function up(): void
    {
        // NOTE: these are built with plain CREATE INDEX, so they take a write lock
        // on the embedding tables for the duration of the build. Run the migration
        // during a maintenance window, or build the HNSW indexes by hand with
        // CREATE INDEX CONCURRENTLY and let this migration no-op via IF NOT EXISTS.
        //
        // Parallel maintenance workers need a large /dev/shm segment; Docker's
        // 64 MB default fails the build with "could not resize shared memory
        // segment: No space left on device". Default to a single worker.
        DB::connection('vectors')->statement(
            'SET max_parallel_maintenance_workers = ' . max(0, (int) config('vector.index_parallel_workers', 0))
        );

        // Plain btree on `model_name` so filtered reads, counts and fallback
        // scans don't fall back to a full table scan. The unique
        // (model_name, model_id) constraint can't serve `model_name`-only
        // predicates efficiently on large tables.
        DB::connection('vectors')->statement('CREATE INDEX IF NOT EXISTS text_embeddings_model_name_idx ON text_embeddings (model_name)');
        DB::connection('vectors')->statement('CREATE INDEX IF NOT EXISTS image_embeddings_model_name_idx ON image_embeddings (model_name)');

        // Partial HNSW indexes, one per queried `model_name`. HNSW can only be
        // scanned when the query's ORDER BY vector operand is known at scan
        // time *and* the surrounding filter doesn't discard most candidates.
        // A `WHERE model_name = ?` filter on the shared index makes the
        // planner prefer a sequential scan; a partial index matches the query
        // exactly, so the index scan is used.
        $textModels = ['artworks', 'articles', 'highlights'];
        $imageModels = ['artworks'];

        foreach ($textModels as $model) {
            DB::connection('vectors')->statement(sprintf(
                'CREATE INDEX IF NOT EXISTS text_embeddings_%s_hnsw_idx ON text_embeddings '
                . 'USING hnsw (embedding vector_cosine_ops) WITH (m = 16, ef_construction = 64) '
                . "WHERE model_name = '%s' AND embedding IS NOT NULL",
                $model,
                $model
            ));
        }

        foreach ($imageModels as $model) {
            DB::connection('vectors')->statement(sprintf(
                'CREATE INDEX IF NOT EXISTS image_embeddings_%s_hnsw_idx ON image_embeddings '
                . 'USING hnsw (embedding vector_cosine_ops) WITH (m = 16, ef_construction = 64) '
                . "WHERE model_name = '%s' AND embedding IS NOT NULL",
                $model,
                $model
            ));
        }
    }

    public function down(): void
    {
        foreach (['artworks', 'articles', 'highlights'] as $model) {
            DB::connection('vectors')->statement("DROP INDEX IF EXISTS text_embeddings_{$model}_hnsw_idx");
        }

        foreach (['artworks'] as $model) {
            DB::connection('vectors')->statement("DROP INDEX IF EXISTS image_embeddings_{$model}_hnsw_idx");
        }

        DB::connection('vectors')->statement('DROP INDEX IF EXISTS text_embeddings_model_name_idx');
        DB::connection('vectors')->statement('DROP INDEX IF EXISTS image_embeddings_model_name_idx');
    }
};
