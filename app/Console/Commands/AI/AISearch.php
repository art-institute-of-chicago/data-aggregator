<?php

namespace App\Console\Commands\AI;

use App\Console\Commands\BaseCommand;
use App\Services\VectorSearchService;
use App\Services\EmbeddingService;
use App\Models\Web\Vectors\TextEmbedding;
use App\Models\Web\Vectors\ImageEmbedding;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Helper\Table;

class AISearch extends BaseCommand
{
    protected $signature = 'ai:search
        {model=all : Model type to search (all, artworks, articles, exhibitions)}
        {--type=semantic : Type of search (semantic, nearest_neighbor, similarity)}
        {--embedding=both : Type of embedding to search (text, image, both)}
        {--query= : Semantic query to search}
        {--id= : ID for nearest neighbor or similarity search}
        {--compare-id= : Second ID for similarity comparison}
        {--limit=20 : Number of results to return}
        {--show-counts : Show counts of embeddings in each table}';

    protected $description = 'Search content using vector embeddings';

    protected VectorSearchService $searchService;
    protected EmbeddingService $embeddingService;

    public function __construct(
        VectorSearchService $searchService,
        EmbeddingService $embeddingService
    ) {
        parent::__construct();
        $this->searchService = $searchService;
        $this->embeddingService = $embeddingService;
    }

    public function handle(): int
    {
        $this->getAicLogo();

        try {
            $model = $this->getModelType();
            $embeddingType = $this->getEmbeddingType($model);
            $searchType = $this->option('type');
            $limit = (int) $this->option('limit');

            if ($this->option('show-counts')) {
                $this->showEmbeddingCounts($model);
            }

            $allResults = new Collection();

            if (in_array($embeddingType, ['text', 'both'])) {
                $textResults = $this->performSearch($model, 'text', $searchType, $limit);
                $allResults = $allResults->concat($textResults);
            }

            if (in_array($embeddingType, ['image', 'both'])) {
                $imageResults = $this->performSearch($model, 'image', $searchType, $limit);
                $allResults = $allResults->concat($imageResults);
            }

            if ($allResults->isEmpty()) {
                $this->warn("\nNo results found");
                return 0;
            }

            $this->displayResults($allResults, $searchType, $embeddingType);
            return 0;
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
            Log::error('AI Search error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return 1;
        }
    }

    protected function getModelType(): string
    {
        $model = $this->argument('model');
        if ($model === 'all') {
            return $this->choice(
                'What type of content do you want to search?',
                ['all', 'artworks', 'articles', 'exhibitions'],
                0
            );
        }
        return $model;
    }

    protected function getEmbeddingType(string $model): string
    {
        $embeddingType = $this->option('embedding');
        $availableTypes = $this->getAvailableEmbeddingTypes($model);

        if ($embeddingType !== 'both' && !in_array($embeddingType, $availableTypes)) {
            return $this->choice(
                'Which embedding type would you like to search?',
                $availableTypes,
                count($availableTypes) - 1
            );
        }

        return $embeddingType;
    }

    protected function getAvailableEmbeddingTypes(string $model): array
    {
        $textCount = TextEmbedding::when($model !== 'all', fn ($q) => $q->where('model_name', $model))->count();
        $imageCount = ImageEmbedding::when($model !== 'all', fn ($q) => $q->where('model_name', $model))->count();

        if ($textCount === 0 && $imageCount === 0) {
            throw new \Exception("No embeddings found for " . ($model === 'all' ? 'any model' : $model));
        }

        $types = [];
        if ($textCount > 0) {
            $types[] = 'text';
        }
        if ($imageCount > 0) {
            $types[] = 'image';
        }
        if (count($types) === 2) {
            $types[] = 'both';
        }

        return $types;
    }

    protected function performSearch(string $model, string $embeddingType, string $searchType, int $limit): Collection
    {
        $this->info("\nSearching {$embeddingType} embeddings...");

        switch ($searchType) {
            case 'semantic':
                $query = $this->option('query') ?? $this->ask('Enter your search query:');
                $this->info("\nUsing query: " . $query);

                $embeddings = $this->embeddingService->getEmbeddings($query);
                return $this->searchService->performSemanticSearch($model, $embeddings, $limit);

            case 'nearest_neighbor':
                $id = (int) $this->option('id');
                if (!$id) {
                    throw new \Exception('ID is required for nearest neighbor search');
                }
                return $this->searchService->findNearestNeighbors($model, $id, $limit);

            case 'similarity':
                $id = (int) $this->option('id');
                $compareId = (int) $this->option('compare-id');
                if (!$id || !$compareId) {
                    throw new \Exception('Both ID and compare-id are required for similarity search');
                }
                return new Collection($this->searchService->calculateSimilarity($model, $id, $compareId));

            default:
                throw new \Exception("Invalid search type: {$searchType}");
        }
    }

    protected function showEmbeddingCounts(string $model): void
    {
        $table = new Table($this->output);
        $table->setHeaders(['Type', 'Count']);

        $textCount = TextEmbedding::when($model !== 'all', fn ($q) => $q->where('model_name', $model))->count();
        $imageCount = ImageEmbedding::when($model !== 'all', fn ($q) => $q->where('model_name', $model))->count();

        $table->setRows([
            ['Text Embeddings', $textCount],
            ['Image Embeddings', $imageCount],
            ['Total', $textCount + $imageCount]
        ]);

        $table->render();
    }

    protected function displayResults(Collection $results, string $searchType, string $embeddingType): void
    {
        $this->info("\nSearch Results:");
        $this->info("---------------");
        $this->info("Total Results: " . $results->count());
        $this->info("Query Type: " . $searchType);
        $this->info("Embedding Types Searched: " . $embeddingType);

        $table = new Table($this->output);
        $table->setHeaders(['#', 'ID', 'Title', 'Source', 'Similarity']);

        $results = $results->sortByDesc('similarity_score');

        $results->each(function ($item, $index) use ($table) {
            $table->addRow([
                $index + 1,
                $item['id'] ?? 'N/A',
                $item['title'] ?? 'N/A',
                $item['embedding_type'] ?? 'N/A',
                isset($item['similarity_score'])
                    ? number_format($item['similarity_score'] * 100, 2) . '%'
                    : 'N/A'
            ]);
        });

        $table->render();
    }
}
