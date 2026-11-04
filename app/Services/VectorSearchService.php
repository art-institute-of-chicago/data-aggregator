<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Web\Vectors\EmbeddingNeighbor;
use App\Models\Web\Vectors\TextEmbedding;
use App\Models\Web\Vectors\ImageEmbedding;
use Pgvector\Laravel\Vector;
use Symfony\Component\HttpFoundation\JsonResponse;

class VectorSearchService
{
    /**
     * Server-side pgvector version, resolved once per process.
     */
    protected static ?string $pgvectorVersion = null;

    /**
     * Prevents repeating the "iterative scan unavailable" warning per query.
     */
    protected static bool $iterativeScanWarningLogged = false;

    /**
     * In-process memo of reference vectors, keyed by "class|model|id".
     * Avoids re-fetching the same (large) vector within a request / command.
     *
     * @var array<string, string>
     */
    protected static array $referenceCache = [];

    public function getItem(string $model, int $id): array
    {
        $modelMap = [
            'artworks' => \App\Models\Collections\Artwork::class,
            'articles' => \App\Models\Web\Article::class,
            'exhibitions' => \App\Models\Web\Exhibition::class
        ];

        // Get base model data
        $modelClass = $modelMap[$model] ?? null;
        if (!$modelClass) {
            throw new \Exception('Invalid model type');
        }

        $item = $modelClass::find($id);
        if (!$item) {
            throw new \Exception('Item not found');
        }

        // Get both text and image embeddings
        $embeddings = collect(['text', 'image'])->mapWithKeys(function ($type) use ($model, $id) {
            $embeddingClass = $type === 'image' ? ImageEmbedding::class : TextEmbedding::class;

            $embedding = $embeddingClass::where('model_name', $model)
                ->where('model_id', $id)
                ->first();

            if ($embedding) {
                return [$type => [
                    'id' => $embedding->id,
                    'version' => $embedding->version,
                    'data' => $embedding->data,
                    'created_at' => $embedding->created_at,
                    'updated_at' => $embedding->updated_at
                ]];
            }

            return [$type => null];
        })->filter()->all();

        return [
            'model' => $model,
            'id' => $id,
            'data' => $item,
            'embeddings' => $embeddings
        ];
    }

    public function performSemanticSearch(string $model, array $embeddings, int $limit): Collection
    {
        $searchVector = (string) new Vector($embeddings);

        $results = $this->withSearchSettings(function () use ($searchVector, $model, $limit) {
            return TextEmbedding::select([
                    'id',
                    'model_name',
                    'model_id',
                ])
                ->selectRaw('embedding <=> ?::vector as distance', [$searchVector])
                ->whereRaw('model_name = ' . $this->modelNameLiteral($model))
                ->whereNotNull('embedding')
                ->orderBy('distance')
                ->limit($limit)
                ->get();
        })->map(function ($item) {
            $item->embedding_type = 'text';
            return $item;
        });

        if ($results->isNotEmpty()) {
            $this->loadImageEmbeddings($results, $model);
        }

        return $results;
    }

    /**
     * Nearest neighbors of a stored item.
     *
     * Served from the `embedding_neighbors` table written by
     * `ai:precompute-neighbors` when a complete, fresh set is available.
     * Otherwise falls back to a live HNSW scan.
     */
    public function findNearestNeighbors(string $model, int $id, int $limit): Collection
    {
        $embeddingType = $model === 'artworks' ? 'image' : 'text';
        $embeddingClass = $embeddingType === 'image' ? ImageEmbedding::class : TextEmbedding::class;

        $precomputed = $this->precomputedNeighbors($embeddingType, $model, $id, $limit);

        if (!is_null($precomputed)) {
            return $precomputed;
        }

        // Use `<=>` (cosine distance) so the hnsw (vector_cosine_ops) index is used;
        // `<->` (L2) does a full sequential scan instead.
        return $this->liveNearestNeighbors(
            $embeddingClass,
            $this->referenceEmbedding($embeddingClass, $model, $id),
            $model,
            $id,
            $limit
        );
    }

    /**
     * Live nearest neighbors of a raw vector.
     *
     * Only selects the fields callers need: skipping `embedding` and `data`
     * avoids transferring full vectors and large JSON blobs (avg ~2KB, max ~39KB).
     * Also used by `ai:precompute-neighbors` to populate the cache.
     *
     * @param  class-string<TextEmbedding|ImageEmbedding>  $embeddingClass
     */
    public function liveNearestNeighbors(
        string $embeddingClass,
        string $vector,
        ?string $model = null,
        ?int $excludeModelId = null,
        int $limit = 25,
        bool $applySearchSettings = true
    ): Collection {
        $embeddingType = $embeddingClass === ImageEmbedding::class ? 'image' : 'text';

        $run = function () use ($embeddingClass, $vector, $model, $excludeModelId, $limit) {
            $query = $embeddingClass::query()
                ->select(['id', 'model_name', 'model_id'])
                ->selectRaw('embedding <=> ?::vector as distance', [$vector])
                ->whereNotNull('embedding')
                ->orderBy('distance')
                ->limit($limit);

            if (!is_null($model)) {
                $query->whereRaw('model_name = ' . $this->modelNameLiteral($model));
            }

            if (!is_null($excludeModelId)) {
                $query->where('model_id', '!=', $excludeModelId);
            }

            return $query->get();
        };

        // Bulk callers (ai:precompute-neighbors) wrap many queries in one
        // transaction and apply the settings themselves.
        $neighbors = $applySearchSettings ? $this->withSearchSettings($run) : $run();

        return $neighbors->map(function ($item) use ($embeddingType) {
            $item->embedding_type = $embeddingType;
            return $item;
        });
    }

    public function calculateSimilarity(string $model, int $id, int $compareId): Collection
    {
        return collect(['text', 'image'])->map(function ($type) use ($model, $id, $compareId) {
            $embeddingClass = $type === 'image' ? ImageEmbedding::class : TextEmbedding::class;

            $embeddings = $embeddingClass::select(['model_id', 'embedding'])
                ->whereIn('model_id', [$id, $compareId])
                ->where('model_name', $model)
                ->get();

            if ($embeddings->count() === 2) {
                $distance = DB::connection('vectors')
                    ->selectOne(
                        "SELECT (?::vector <=> ?::vector) as distance",
                        [
                            $embeddings[0]->embedding,
                            $embeddings[1]->embedding
                        ]
                    )->distance;

                return [
                    'embedding_type' => $type,
                    'similarity_score' => 1 - $distance,
                    'items' => [
                        'id1' => $embeddings[0]->model_id,
                        'id2' => $embeddings[1]->model_id
                    ]
                ];
            }
            return null;
        })->filter();
    }

    public function findNeighborsBetween(string $embeddingType, string $firstItemModel, int $firstItemId, string $secondItemModel, int $secondItemId)
    {
        if (!in_array($embeddingType, ['text', 'image'])) {
            return collect();
        }

        $embeddingClass = 'App\\Models\\Web\\Vectors\\' . Str::ucfirst($embeddingType) . 'Embedding';

        // Resolve both reference vectors up front. The previous version put a
        // correlated subquery in WHERE / ORDER BY, which the planner cannot feed
        // to an HNSW index (the vector operand was unknown at scan time) and
        // which re-executed once per candidate row. With the vectors in hand the
        // distance expression is a bound parameter, so the index scan is used
        // and the lookup happens once instead of per row.
        $first = $this->referenceEmbedding($embeddingClass, $firstItemModel, $firstItemId);
        $second = $this->referenceEmbedding($embeddingClass, $secondItemModel, $secondItemId);

        $columns = ['id', 'model_name', 'model_id'];

        $referenceDistance = (float) DB::connection('vectors')->selectOne(
            'SELECT (?::vector <=> ?::vector) as distance',
            [$first, $second]
        )->distance;

        if ($referenceDistance < 0.001) {
            $betweenItems = $this->liveNearestNeighbors($embeddingClass, $first, null, null, 50);
        } else {
            $tolerance = max($referenceDistance * 0.5, 0.1);

            // The ABS() expression is not indexable either way, but it now runs
            // against bound vectors instead of three correlated subqueries.
            $betweenItems = $this->withSearchSettings(function () use ($embeddingClass, $columns, $first, $second, $referenceDistance, $tolerance) {
                return $embeddingClass::query()
                    ->select($columns)
                    ->selectRaw('ABS(((embedding <=> ?::vector) + (embedding <=> ?::vector)) - ?) as delta', [
                        $first,
                        $second,
                        $referenceDistance
                    ])
                    ->selectRaw('embedding <=> ?::vector as distance', [$first])
                    ->whereRaw('ABS(((embedding <=> ?::vector) + (embedding <=> ?::vector)) - ?) < ?', [
                        $first,
                        $second,
                        $referenceDistance,
                        $tolerance
                    ])
                    ->orderByRaw('ABS(((embedding <=> ?::vector) + (embedding <=> ?::vector)) - ?)', [
                        $first,
                        $second,
                        $referenceDistance
                    ])
                    ->limit(1000)
                    ->get();
            }, 200);
        }

        return $betweenItems;
    }

    public function compareNeighbors(string $firstEmbeddingType, string $firstItemModel, int $firstItemId, string $secondEmbeddingType, string $secondItemModel, int $secondItemId)
    {
        if (!in_array($firstEmbeddingType, ['text', 'image']) || !in_array($secondEmbeddingType, ['text', 'image'])) {
            return collect();
        }

        $firstEmbeddingClass = 'App\\Models\\Web\\Vectors\\' . Str::ucfirst($firstEmbeddingType) . 'Embedding';
        $secondEmbeddingClass = 'App\\Models\\Web\\Vectors\\' . Str::ucfirst($secondEmbeddingType) . 'Embedding';

        $firstNeighbors = $this->liveNearestNeighbors(
            $firstEmbeddingClass,
            $this->referenceEmbedding($firstEmbeddingClass, $firstItemModel, $firstItemId),
            null,
            null,
            100
        );

        $secondNeighbors = $this->liveNearestNeighbors(
            $secondEmbeddingClass,
            $this->referenceEmbedding($secondEmbeddingClass, $secondItemModel, $secondItemId),
            null,
            null,
            100
        );

        $sharedItems = $firstNeighbors->filter(function ($firstItem) use ($secondNeighbors) {
            return $secondNeighbors->contains(function ($secondItem) use ($firstItem) {
                return $firstItem->model_name === $secondItem->model_name &&
                    $firstItem->model_id === $secondItem->model_id;
            });
        });

        return $sharedItems;
    }

    public function findImageNearestNeighbors(string $model, array $embeddings, int $limit): Collection
    {
        $searchVector = (string) new Vector($embeddings);

        $modelMap = [
            'artworks' => \App\Models\Collections\Artwork::class,
            'articles' => \App\Models\Web\Article::class,
            'exhibitions' => \App\Models\Web\Exhibition::class
        ];

        $results = $this->withSearchSettings(function () use ($searchVector, $model, $limit) {
            return ImageEmbedding::select([
                    'id',
                    'model_name',
                    'model_id',
                    'created_at',
                    'updated_at',
                ])
                ->selectRaw('embedding <=> ?::vector as distance', [$searchVector])
                ->whereRaw('model_name = ' . $this->modelNameLiteral($model))
                ->whereNotNull('embedding')
                ->orderBy('distance')
                ->limit($limit)
                ->get();
        })->map(function ($item) {
            $item->embedding_type = 'image';
            return $item;
        });

        if ($results->isNotEmpty() && isset($modelMap[$model])) {
            $modelClass = $modelMap[$model];
            $modelData = $modelClass::whereIn('id', $results->pluck('model_id'))
                ->get()
                ->keyBy('id');

            $results->each(function ($item) use ($modelData) {
                $item->model_data = $modelData->get($item->model_id);
            });
        }

        return $results;
    }

    protected function loadImageEmbeddings(Collection $results, string $model): void
    {
        $imageEmbeddings = ImageEmbedding::where('model_name', $model)
            ->whereIn('model_id', $results->pluck('model_id'))
            ->select(['model_id', 'data'])
            ->get()
            ->keyBy('model_id');

        $results->each(function ($item) use ($imageEmbeddings) {
            $item->image_embedding_data = $imageEmbeddings->get($item->model_id)?->data;
        });
    }

    /**
     * Apply HNSW search settings inside a transaction via `SET LOCAL`.
     *
     * `SET LOCAL` scopes the settings to the query being run, so a tuned
     * `ef_search` for one endpoint can't leak into unrelated queries on the
     * same pooled connection.
     *
     * - ef_search: candidate list size. pgvector defaults to 40; higher costs a
     *   little speed but keeps recall up on filtered queries.
     * - iterative_scan / max_scan_tuples (pgvector >= 0.8): lets a filtered
     *   nearest-neighbor query keep scanning the index until it has enough
     *   surviving rows, instead of returning a short (or empty) result set.
     */
    public function withSearchSettings(callable $callback, ?int $efSearch = null)
    {
        return DB::connection('vectors')->transaction(function () use ($callback, $efSearch) {
            $this->applySearchSettings($efSearch, local: true);

            return $callback();
        });
    }

    protected function applySearchSettings(?int $efSearch = null, bool $local = false): void
    {
        // hnsw GUCs only exist from pgvector 0.5 onwards.
        if (!version_compare($this->pgvectorVersion(), '0.5.0', '>=')) {
            return;
        }

        $connection = DB::connection('vectors');
        $prefix = $local ? 'SET LOCAL ' : 'SET ';

        try {
            $connection->statement(
                $prefix . 'hnsw.ef_search = ' . max(1, $efSearch ?? (int) config('vector.ef_search', 100))
            );
        } catch (\Throwable $e) {
            report($e);
        }

        if (!$this->supportsIterativeScan()) {
            // Filtered HNSW queries fall back to partial indexes on older servers.
            // Surface it once per process rather than failing silently.
            if (!self::$iterativeScanWarningLogged && config('vector.iterative_scan') !== 'off') {
                self::$iterativeScanWarningLogged = true;

                Log::warning('pgvector < 0.8: hnsw.iterative_scan unavailable', [
                    'version' => $this->pgvectorVersion(),
                ]);
            }

            return;
        }

        $iterativeScan = (string) config('vector.iterative_scan', 'relaxed_order');

        if (!in_array($iterativeScan, ['off', 'relaxed_order', 'strict_order'], true)) {
            return;
        }

        $maxScanTuples = max(1, (int) config('vector.max_scan_tuples', 20000));

        $connection->statement($prefix . 'hnsw.iterative_scan = ' . $iterativeScan);
        $connection->statement($prefix . 'hnsw.max_scan_tuples = ' . $maxScanTuples);
    }

    /**
     * Server-side pgvector version, resolved once per process.
     */
    public function pgvectorVersion(): string
    {
        if (is_null(self::$pgvectorVersion)) {
            try {
                $row = DB::connection('vectors')->selectOne(
                    "SELECT extversion FROM pg_extension WHERE extname = 'vector'"
                );
                self::$pgvectorVersion = $row->extversion ?? '0.0.0';
            } catch (\Throwable $e) {
                self::$pgvectorVersion = '0.0.0';
            }
        }

        return self::$pgvectorVersion;
    }

    public function supportsIterativeScan(): bool
    {
        return version_compare($this->pgvectorVersion(), '0.8.0', '>=');
    }

    /**
     * Fetch a reference vector as a bindable string, memoized for the process.
     *
     * @param  class-string<TextEmbedding|ImageEmbedding>  $embeddingClass
     */
    protected function referenceEmbedding(string $embeddingClass, string $model, int $id): string
    {
        $key = $embeddingClass . '|' . $model . '|' . $id;

        if (isset(self::$referenceCache[$key])) {
            return self::$referenceCache[$key];
        }

        $embedding = $embeddingClass::where('model_name', $model)
            ->where('model_id', $id)
            ->whereNotNull('embedding')
            ->value('embedding');

        if (is_null($embedding)) {
            throw (new \Illuminate\Database\Eloquent\ModelNotFoundException())->setModel($embeddingClass, [$id]);
        }

        return self::$referenceCache[$key] = (string) $embedding;
    }

    /**
     * Quote a `model_name` so it can be inlined as a literal.
     *
     * The per-model HNSW indexes are *partial* (`WHERE model_name = 'artworks'`).
     * Postgres can only match a partial index when the predicate is known at
     * plan time, and a bound parameter (`model_name = $1`) is not. Inlining the
     * value lets those indexes actually be selected. The value is quoted, so
     * this stays injection-safe.
     */
    protected function modelNameLiteral(string $model): string
    {
        return DB::connection('vectors')->getPdo()->quote($model);
    }

    /**
     * Read precomputed neighbors, or null when there is no complete, fresh set.
     */
    protected function precomputedNeighbors(string $embeddingType, string $model, int $id, int $limit): ?Collection
    {
        if (!config('vector.neighbors.enabled', true) || $limit < 1) {
            return null;
        }

        // Select with aliases so the shape matches a live query result exactly.
        try {
            $rows = EmbeddingNeighbor::query()
                ->where('embedding_type', $embeddingType)
                ->where('model_name', $model)
                ->where('model_id', $id)
                ->orderBy('rank')
                ->limit($limit)
                ->get([
                    DB::raw('neighbor_id as id'),
                    DB::raw('neighbor_model_name as model_name'),
                    DB::raw('neighbor_model_id as model_id'),
                    'distance',
                    'computed_at',
                ]);
        } catch (\Throwable $e) {
            // Table not migrated yet: fall back to a live scan.
            return null;
        }

        if ($rows->count() < $limit) {
            return null;
        }

        $maxAgeDays = (int) config('vector.neighbors.max_age_days', 30);

        if ($maxAgeDays > 0 && $rows->first()->computed_at?->lt(now()->subDays($maxAgeDays))) {
            return null;
        }

        return $rows->map(function ($row) use ($embeddingType) {
            $row->embedding_type = $embeddingType;
            return $row;
        });
    }

    /**
     * Incrementally repair precomputed neighbor lists after one embedding is
     * created or changed.
     *
     * A new/changed vector can affect three sets:
     *   1. the item itself (its own list is recomputed),
     *   2. items whose lists already point at it (stale by definition - they may
     *      have to drop it, which the new vector's own neighbors can't reveal), and
     *   3. items that would newly include it: its `limit + oversample` nearest
     *      neighbors, filtered to those where the new distance actually beats
     *      the item's current worst stored distance.
     *
     * @param  class-string<TextEmbedding|ImageEmbedding>  $embeddingClass
     * @return array{updated: int, candidates: int}
     */
    public function repairNeighbors(
        string $embeddingClass,
        string $modelName,
        int $modelId,
        ?string $previousVector = null
    ): array {
        $empty = ['updated' => 0, 'candidates' => 0];

        if (!config('vector.neighbors.enabled', true) || !config('vector.neighbors.auto_repair', true)) {
            return $empty;
        }

        $limit = max(1, (int) config('vector.neighbors.limit', 25));
        $oversample = max(0, (int) config('vector.neighbors.oversample', 10));
        $embeddingType = $embeddingClass === ImageEmbedding::class ? 'image' : 'text';

        $current = $embeddingClass::where('model_name', $modelName)
            ->where('model_id', $modelId)
            ->whereNotNull('embedding')
            ->value('embedding');

        $currentVector = is_null($current) ? null : (string) $current;

        if (is_null($currentVector) && is_null($previousVector)) {
            return $empty;
        }

        // 1. This item's own list.
        if (!is_null($currentVector)) {
            $this->storeNeighbors(
                $embeddingType,
                $modelName,
                $modelId,
                $this->liveNearestNeighbors($embeddingClass, $currentVector, $modelName, $modelId, $limit),
                $limit
            );
        }

        // 2. Items whose list points at this item (sentinel: must recompute).
        $candidates = [];

        $listingIds = EmbeddingNeighbor::where('embedding_type', $embeddingType)
            ->where('neighbor_model_name', $modelName)
            ->where('neighbor_model_id', $modelId)
            ->pluck('model_id');

        foreach ($listingIds as $listingId) {
            $candidates[(int) $listingId] = INF;
        }

        // 3. Items this vector now lands near - oversampled, so rank boundary
        // shifts are covered without a full sweep.
        $vectors = array_values(array_filter([$currentVector, $previousVector], fn ($vector) => !is_null($vector)));

        foreach ($vectors as $vector) {
            $nearby = $this->liveNearestNeighbors(
                $embeddingClass,
                $vector,
                $modelName,
                $modelId,
                $limit + $oversample
            );

            foreach ($nearby as $neighbor) {
                if ((int) $neighbor->model_id === $modelId) {
                    continue;
                }

                $id = (int) $neighbor->model_id;
                $candidates[$id] = min($candidates[$id] ?? INF, (float) $neighbor->distance);
            }
        }

        if (empty($candidates)) {
            return $empty;
        }

        // Only recompute a candidate when the new distance displaces something.
        $worst = EmbeddingNeighbor::where('embedding_type', $embeddingType)
            ->where('model_name', $modelName)
            ->whereIn('model_id', array_keys($candidates))
            ->where('rank', $limit)
            ->pluck('distance', 'model_id');

        $updated = 0;

        foreach ($candidates as $candidateId => $distance) {
            $threshold = $worst[$candidateId] ?? null;

            if (!is_null($threshold) && is_finite($distance) && $distance >= (float) $threshold) {
                continue;
            }

            $vector = $embeddingClass::where('model_name', $modelName)
                ->where('model_id', $candidateId)
                ->whereNotNull('embedding')
                ->value('embedding');

            if (is_null($vector)) {
                continue;
            }

            $this->storeNeighbors(
                $embeddingType,
                $modelName,
                (int) $candidateId,
                $this->liveNearestNeighbors($embeddingClass, (string) $vector, $modelName, (int) $candidateId, $limit),
                $limit
            );

            $updated++;
        }

        return ['updated' => $updated, 'candidates' => count($candidates)];
    }

    /**
     * Replace one item's precomputed list.
     *
     * @param  Collection<int, \Illuminate\Database\Eloquent\Model>  $neighbors
     * @return int number of ranks written
     */
    public function storeNeighbors(
        string $embeddingType,
        string $modelName,
        int $modelId,
        Collection $neighbors,
        int $limit
    ): int {
        $records = [];
        $rank = 0;

        foreach ($neighbors as $neighbor) {
            if (++$rank > $limit) {
                break;
            }

            $records[] = [
                'embedding_type' => $embeddingType,
                'model_name' => $modelName,
                'model_id' => $modelId,
                'rank' => $rank,
                'neighbor_id' => $neighbor->id,
                'neighbor_model_name' => $neighbor->model_name,
                'neighbor_model_id' => $neighbor->model_id,
                'distance' => $neighbor->distance,
                'computed_at' => now(),
            ];
        }

        // Ranks beyond the new list length no longer exist.
        EmbeddingNeighbor::where('embedding_type', $embeddingType)
            ->where('model_name', $modelName)
            ->where('model_id', $modelId)
            ->where('rank', '>', count($records))
            ->delete();

        if (!empty($records)) {
            EmbeddingNeighbor::upsert(
                $records,
                ['embedding_type', 'model_name', 'model_id', 'rank'],
                ['neighbor_id', 'neighbor_model_name', 'neighbor_model_id', 'distance', 'computed_at']
            );
        }

        return count($records);
    }

    /**
     * Drop precomputed rows whose source or target embedding no longer exists.
     */
    public function pruneNeighbors(?string $embeddingType = null, ?string $modelName = null): int
    {
        $deleted = 0;

        $tables = ['text' => 'text_embeddings', 'image' => 'image_embeddings'];

        foreach ($tables as $type => $table) {
            if (!is_null($embeddingType) && $embeddingType !== $type) {
                continue;
            }

            $sql = "DELETE FROM embedding_neighbors
                    WHERE embedding_type = ?
                      AND (
                        NOT EXISTS (
                            SELECT 1 FROM {$table} s
                            WHERE s.model_name = embedding_neighbors.model_name
                              AND s.model_id = embedding_neighbors.model_id
                        )
                        OR NOT EXISTS (
                            SELECT 1 FROM {$table} n
                            WHERE n.id = embedding_neighbors.neighbor_id
                        )
                      )";

            $bindings = [$type];

            if (!is_null($modelName)) {
                $sql .= ' AND model_name = ?';
                $bindings[] = $modelName;
            }

            $deleted += DB::connection('vectors')->delete($sql, $bindings);
        }

        return $deleted;
    }

    public function formatResponse($results, mixed $model, mixed $id = null): JsonResponse
    {
        if ($results->isEmpty()) {
            return response()->json([
                'message' => 'No items found'
            ], 404);
        }

        return response()->json([
            'count' => $results->count(),
            'items' => $results->sortBy('distance')->values(),
            'model' => $model,
            'id' => $id,
            'total' => $results->count()
        ]);
    }
}
