<?php

return [

    /*
    |--------------------------------------------------------------------------
    | HNSW Search Settings
    |--------------------------------------------------------------------------
    |
    | Applied per-connection before nearest-neighbor queries run against the
    | `vectors` (pgvector) connection. `ef_search` trades recall for speed:
    | higher = better recall, slower queries. The pgvector defaults are
    | ef_search = 40 and iterative_scan = off.
    |
    | `iterative_scan` and `max_scan_tuples` require pgvector >= 0.8. They are
    | skipped automatically on older servers, where filtered queries over
    | HNSW fall back to sequential scans unless a matching partial index
    | exists (see the add_vector_search_indexes migration).
    |
    */

    'ef_search' => (int) env('VECTORS_EF_SEARCH', 100),

    'iterative_scan' => env('VECTORS_ITERATIVE_SCAN', 'relaxed_order'),

    'max_scan_tuples' => (int) env('VECTORS_MAX_SCAN_TUPLES', 20000),

    /*
    |--------------------------------------------------------------------------
    | Precomputed Neighbors
    |--------------------------------------------------------------------------
    |
    | `ai:precompute-neighbors` fills the `embedding_neighbors` table so that
    | nearest-neighbor reads become a single btree lookup instead of an HNSW
    | scan at request time. Reads fall back to a live scan when an item has no
    | precomputed rows, when the caller asks for more neighbors than were
    | stored, or when the rows are older than `max_age_days` (0 = never
    | expires).
    |
    */

    'neighbors' => [
        'enabled' => (bool) env('VECTORS_PRECOMPUTED_NEIGHBORS', true),
        'limit' => (int) env('VECTORS_PRECOMPUTED_LIMIT', 25),
        'max_age_days' => (int) env('VECTORS_PRECOMPUTED_MAX_AGE_DAYS', 30),

        // Repair affected lists synchronously whenever an embedding is written
        // (see HandleEmbeddings::saveEmbeddings). Disable to rely on the sweep.
        'auto_repair' => (bool) env('VECTORS_PRECOMPUTED_AUTO_REPAIR', true),

        // Extra neighbors fetched when repairing, so a new vector's arrival can
        // still be detected after rank boundaries shift.
        'oversample' => (int) env('VECTORS_PRECOMPUTED_OVERSAMPLE', 10),
    ],

    /*
    |--------------------------------------------------------------------------
    | Index Build Settings
    |--------------------------------------------------------------------------
    |
    | HNSW builds hand their work to parallel maintenance workers through dynamic
    | shared memory, which lives in /dev/shm. Docker defaults that to 64 MB, so
    | `CREATE INDEX` fails with "could not resize shared memory segment: No space
    | left on device" even when the disk is empty. Building with a single worker
    | needs no shared segment, at the cost of a slower build.
    |
    | Set VECTORS_INDEX_PARALLEL_WORKERS above 0 (and raise the container's
    | shm_size, e.g. 1gb) if you would rather trade memory for build speed.
    |
    */

    'index_parallel_workers' => (int) env('VECTORS_INDEX_PARALLEL_WORKERS', 0),

];
