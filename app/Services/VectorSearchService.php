<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Web\Vectors\TextEmbedding;
use App\Models\Web\Vectors\ImageEmbedding;
use Pgvector\Laravel\Vector;
use Symfony\Component\HttpFoundation\JsonResponse;

class VectorSearchService
{
    protected string $connection = 'vectors';

    public function performSemanticSearch(string $model, array $embeddings, int $limit): Collection
    {
        $searchVector = new Vector($embeddings);

        $results = TextEmbedding::on($this->connection)
            ->select([
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

        $reference = $embeddingClass::on($this->connection)
            ->where('model_name', $model)
            ->where('model_id', $id)
            ->firstOrFail();

        return $embeddingClass::on($this->connection)
            ->select([
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

            $embeddings = $embeddingClass::on($this->connection)
                ->select('*')
                ->whereIn('model_id', [$id, $compareId])
                ->where('model_name', $model)
                ->get();

            if ($embeddings->count() === 2) {
                $distance = DB::connection($this->connection)
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

    protected function loadImageEmbeddings(Collection $results, string $model): void
    {
        $imageEmbeddings = ImageEmbedding::on($this->connection)
            ->where('model_name', $model)
            ->whereIn('model_id', $results->pluck('model_id'))
            ->get()
            ->keyBy('model_id');

        $results->each(function ($item) use ($imageEmbeddings) {
            $item->image_embedding_data = $imageEmbeddings->get($item->model_id)?->data;
        });
    }

    public function formatResponse($results, string $model, ?int $id = null): JsonResponse
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
