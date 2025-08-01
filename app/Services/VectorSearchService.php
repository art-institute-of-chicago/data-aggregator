<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Web\Vectors\TextEmbedding;
use App\Models\Web\Vectors\ImageEmbedding;
use Pgvector\Laravel\Vector;
use Symfony\Component\HttpFoundation\JsonResponse;

class VectorSearchService
{
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
        $searchVector = new Vector($embeddings);

        $results = TextEmbedding::select([
                '*',
                DB::raw("embedding <-> '" . $searchVector . "' as distance")
            ])
            ->where('model_name', $model)
            ->whereNotNull('embedding')
            ->orderBy('distance')
            ->limit($limit)
            ->get()
            ->map(function ($item) {
                $item->embedding_type = 'text';
                return $item;
            });

        if ($results->isNotEmpty()) {
            $this->loadImageEmbeddings($results, $model);
        }

        return $results;
    }

    public function findNearestNeighbors(string $model, int $id, int $limit): Collection
    {
        $embeddingClass = $model === 'artworks' ? ImageEmbedding::class : TextEmbedding::class;

        $reference = $embeddingClass::where('model_name', $model)
            ->where('model_id', $id)
            ->firstOrFail();

        return $embeddingClass::select([
                '*',
                DB::raw("embedding <-> '" . $reference->embedding . "' as distance")
            ])
            ->where('model_name', $model)
            ->where('model_id', '!=', $id)
            ->whereNotNull('embedding')
            ->orderBy('distance')
            ->limit($limit)
            ->get()
            ->map(function ($item) use ($model) {
                $item->embedding_type = $model === 'artworks' ? 'image' : 'text';
                return $item;
            });
    }

    public function calculateSimilarity(string $model, int $id, int $compareId): Collection
    {
        return collect(['text', 'image'])->map(function ($type) use ($model, $id, $compareId) {
            $embeddingClass = $type === 'image' ? ImageEmbedding::class : TextEmbedding::class;

            $embeddings = $embeddingClass::select('*')
                ->whereIn('model_id', [$id, $compareId])
                ->where('model_name', $model)
                ->get();

            if ($embeddings->count() === 2) {
                $distance = DB::connection('vectors')
                    ->selectOne(
                        "SELECT (?::vector <-> ?::vector) as distance",
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

        if (!isset($firstItemModel, $firstItemId, $secondItemModel, $secondItemId)) {
            return collect();
        }

        $embeddingClass = 'App\\Models\\Web\\Vectors\\' . Str::ucfirst($embeddingType) . 'Embedding';

        $items = [
            (object) [
                'model_name' => $firstItemModel,
                'model_id' => $firstItemId,
            ],
            (object) [
                'model_name' => $secondItemModel,
                'model_id' => $secondItemId,
            ]
        ];

        foreach ($items as $item) {
            $reference = $embeddingClass::where('model_name', $item->model_name)
                ->where('model_id', $item->model_id)
                ->firstOrFail();
            $item->embedding = $reference->embedding;
        }

        $referenceDistance = DB::connection('vectors')->selectOne(
            "SELECT (e1.embedding <=> e2.embedding) as distance
            FROM {$embeddingClass::getModel()->getTable()} e1, {$embeddingClass::getModel()->getTable()} e2
            WHERE e1.model_name = ? AND e1.model_id = ?
            AND e2.model_name = ? AND e2.model_id = ?",
            [$items[0]->model_name, $items[0]->model_id, $items[1]->model_name, $items[1]->model_id]
        )->distance;

        if ($referenceDistance < 0.001) {
            $betweenItems = $embeddingClass::query()
                ->whereRaw(
                    'embedding <=> (SELECT embedding FROM ' . $embeddingClass::getModel()->getTable() . ' WHERE model_name = ? AND model_id = ?) < 1.0',
                    [$items[0]->model_name, $items[0]->model_id]
                )
                ->orderByRaw(
                    'embedding <=> (SELECT embedding FROM ' . $embeddingClass::getModel()->getTable() . ' WHERE model_name = ? AND model_id = ?)',
                    [$items[0]->model_name, $items[0]->model_id]
                )
                ->limit(50)
                ->get();
        } else {
            $tolerance = max($referenceDistance * 0.5, 0.1);

            $betweenItems = $embeddingClass::query()
              ->whereRaw('ABS(((embedding <=> (SELECT embedding FROM ' . $embeddingClass::getModel()->getTable() . ' WHERE model_name = ? AND model_id = ?)) +
                                  (embedding <=> (SELECT embedding FROM ' . $embeddingClass::getModel()->getTable() . ' WHERE model_name = ? AND model_id = ?))) - ?) < ?', [
                  $items[0]->model_name, $items[0]->model_id,
                  $items[1]->model_name, $items[1]->model_id,
                  $referenceDistance,
                  $tolerance
              ])
              ->orderByRaw('ABS(((embedding <=> (SELECT embedding FROM ' . $embeddingClass::getModel()->getTable() . ' WHERE model_name = ? AND model_id = ?)) +
                                  (embedding <=> (SELECT embedding FROM ' . $embeddingClass::getModel()->getTable() . ' WHERE model_name = ? AND model_id = ?))) - ?)', [
                  $items[0]->model_name, $items[0]->model_id,
                  $items[1]->model_name, $items[1]->model_id,
                  $referenceDistance
              ])
              ->limit(1000)
              ->get();
        }

        return $betweenItems;
    }

    public function compareNeighbors(string $firstEmbeddingType, string $firstItemModel, int $firstItemId, string $secondEmbeddingType, string $secondItemModel, int $secondItemId)
    {
        if (!in_array($firstEmbeddingType, ['text', 'image']) || !in_array($secondEmbeddingType, ['text', 'image'])) {
            return collect();
        }

        if (!isset($firstItemModel, $firstItemId, $secondItemModel, $secondItemId)) {
            return collect();
        }

        $firstEmbeddingClass = 'App\\Models\\Web\\Vectors\\' . Str::ucfirst($firstEmbeddingType) . 'Embedding';
        $secondEmbeddingClass = 'App\\Models\\Web\\Vectors\\' . Str::ucfirst($secondEmbeddingType) . 'Embedding';

        $firstNeighbors = $firstEmbeddingClass::query()
          ->whereRaw(
              'embedding <=> (SELECT embedding FROM ' . $firstEmbeddingClass::getModel()->getTable() . ' WHERE model_name = ? AND model_id = ?) < 1.0',
              [$firstItemModel, $firstItemId]
          )
          ->orderByRaw(
              'embedding <=> (SELECT embedding FROM ' . $firstEmbeddingClass::getModel()->getTable() . ' WHERE model_name = ? AND model_id = ?)',
              [$firstItemModel, $firstItemId]
          )
          ->limit(100)
          ->get();

        $secondNeighbors = $secondEmbeddingClass::query()
          ->whereRaw(
              'embedding <=> (SELECT embedding FROM ' . $secondEmbeddingClass::getModel()->getTable() . ' WHERE model_name = ? AND model_id = ?) < 1.0',
              [$secondItemModel, $secondItemId]
          )
          ->orderByRaw(
              'embedding <=> (SELECT embedding FROM ' . $secondEmbeddingClass::getModel()->getTable() . ' WHERE model_name = ? AND model_id = ?)',
              [$secondItemModel, $secondItemId]
          )
          ->limit(100)
          ->get();

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
        $searchVector = new Vector($embeddings);

        $modelMap = [
            'artworks' => \App\Models\Collections\Artwork::class,
            'articles' => \App\Models\Web\Article::class,
            'exhibitions' => \App\Models\Web\Exhibition::class
        ];

        $results = ImageEmbedding::select([
                '*',
                DB::raw("embedding <-> '" . $searchVector . "' as distance")
            ])
            ->where('model_name', $model)
            ->whereNotNull('embedding')
            ->orderBy('distance')
            ->limit($limit)
            ->get()
            ->map(function ($item) {
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
            ->get()
            ->keyBy('model_id');

        $results->each(function ($item) use ($imageEmbeddings) {
            $item->image_embedding_data = $imageEmbeddings->get($item->model_id)?->data;
        });
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
