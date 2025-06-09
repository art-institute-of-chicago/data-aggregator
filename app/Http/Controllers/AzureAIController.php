<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VectorSearchService;
use Symfony\Component\HttpFoundation\JsonResponse;

class AzureAIController extends Controller
{
    protected VectorSearchService $searchService;

    public function __construct(
        VectorSearchService $searchService
    ) {
        $this->searchService = $searchService;
    }

    public function show()
    {
        return response()->json([
            'message' => 'Hello, World!'
        ], 200);
    }

    public function getItem(string $model, int $id): JsonResponse
    {
        try {
            $result = $this->searchService->getItem($model, $id);
            return response()->json($result);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function semanticSearch(Request $request, string $model): JsonResponse
    {
        try {
            if (empty($request->query('q'))) {
                return response()->json([
                    'error' => 'Search query (q) is required for semantic search'
                ], 400);
            }

            $searchQuery = app('Embeddings')->normalizeQuery(
                htmlspecialchars($request->query('q'), ENT_QUOTES, 'UTF-8')
            );

            $embeddings = app('Embeddings')->getEmbeddings($searchQuery);

            if (!$embeddings) {
                return response()->json([
                    'error' => 'Could not generate embeddings for search query'
                ], 400);
            }

            $results = $this->searchService->performSemanticSearch(
                model: $model,
                embeddings: $embeddings,
                limit: $request->query('limit', 20)
            );

            return $this->searchService->formatResponse($results, $model);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function nearestNeighbor(Request $request, string $model, int $id): JsonResponse
    {
        try {
            $results = $this->searchService->findNearestNeighbors(
                model: $model,
                id: $id,
                limit: $request->query('limit', 20)
            );

            return $this->searchService->formatResponse($results, $model, $id);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function similarity(string $model, int $id, int $compareId): JsonResponse
    {
        try {
            $similarityScores = $this->searchService->calculateSimilarity($model, $id, $compareId);
            return response()->json(['similarity_scores' => $similarityScores]);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function findImageNearestNeighbors(Request $request): JsonResponse
    {
        try {
            $imageUrl = $request->input('image_url');
            $model = $request->input('model', 'artworks');
            $limit = $request->input('limit', 10);

            // Generate embeddings for the provided image URL
            $imageEmbeddings = app('Embeddings')->getImageEmbeddings($imageUrl);

            if (!$imageEmbeddings) {
                return response()->json([
                    'error' => 'Failed to generate embeddings for the provided image'
                ], 400);
            }

            // Find nearest neighbors using the generated embeddings
            $results = $this->searchService->findImageNearestNeighbors(
                $model,
                $imageEmbeddings,
                $limit
            );

            return response()->json([
                'count' => $results->count(),
                'query_image_url' => $imageUrl,
                'model' => $model,
                'results' => $results->map(function ($item) {
                    return [
                        'id' => $item->model_id,
                        'url' => 'https://artic.edu/artworks/'. $item->model_id,
                        'distance' => round($item->distance, 4),
                        'similarity_score' => round(1 - $item->distance, 4),
                        'embedding_type' => $item->embedding_type,
                        'model_data' => $item->model_data ?? null,
                        'created_at' => $item->created_at,
                        'updated_at' => $item->updated_at
                    ];
                })->sortBy('distance')->values()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to process image search',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    protected function handleError(\Exception $e): JsonResponse
    {
        return response()->json([
            'error' => 'An error occurred while processing your request',
            'message' => $e->getMessage(),
            'trace' => config('app.debug') ? $e->getTraceAsString() : null
        ], 500);
    }
}
