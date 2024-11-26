<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\VectorSearchService;
use App\Services\EmbeddingService;
use App\Models\Web\Vectors\TextEmbedding;
use App\Models\Web\Vectors\ImageEmbedding;
use Symfony\Component\HttpFoundation\JsonResponse;
use Pgvector\Laravel\Vector;

class AzureAIController extends Controller
{
    protected string $connection = 'vectors';
    protected EmbeddingService $embeddingService;
    protected VectorSearchService $searchService;

    public function __construct(
        EmbeddingService $embeddingService,
        VectorSearchService $searchService
    ) {
        $this->embeddingService = $embeddingService;
        $this->searchService = $searchService;
    }

    public function semanticSearch(Request $request, string $model): JsonResponse
    {
        try {
            if (empty($request->query('q'))) {
                return response()->json([
                    'error' => 'Search query (q) is required for semantic search'
                ], 400);
            }

            $searchQuery = $this->embeddingService->normalizeQuery(
                htmlspecialchars($request->query('q'), ENT_QUOTES, 'UTF-8')
            );

            $embeddings = $this->embeddingService->getEmbeddings($searchQuery);
            
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

    protected function handleError(\Exception $e): JsonResponse
    {
        return response()->json([
            'error' => 'An error occurred while processing your request',
            'message' => $e->getMessage(),
            'trace' => config('app.debug') ? $e->getTraceAsString() : null
        ], 500);
    }
}