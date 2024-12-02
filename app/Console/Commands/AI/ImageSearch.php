<?php

namespace App\Console\Commands\AI;

use App\Console\Commands\BaseCommand;
use App\Services\EmbeddingService;
use App\Services\VectorSearchService;
use App\Models\Web\Vectors\ImageEmbedding;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;

class ImageSearch extends BaseCommand
{
    protected $signature = 'ai:search-image
        {url? : URL of the image to search}
        {--limit=10 : Number of results to return}
        {--threshold=0.8 : Similarity threshold (0-1)}
        {--model= : Specific model type to search (artworks, articles, exhibitions)}';

    protected $description = 'Search for similar images using vector embeddings';

    protected EmbeddingService $embeddingService;
    protected VectorSearchService $searchService;

    public function __construct(
        EmbeddingService $embeddingService,
        VectorSearchService $searchService
    ) {
        parent::__construct();
        $this->embeddingService = $embeddingService;
        $this->searchService = $searchService;
    }

    public function handle(): int
    {
        $this->getAicLogo();

        try {
            // Get image URL
            $url = $this->argument('url') ?? $this->ask('Enter the image URL to search:');
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                throw new \Exception('Invalid URL provided');
            }

            $this->info("\nFetching image embeddings...");
            $vector = $this->embeddingService->getImageEmbeddings($url);

            $this->info("Searching for similar images...");
            $results = $this->searchSimilarImages(
                vector: $vector,
                limit: (int) $this->option('limit'),
                threshold: (float) $this->option('threshold'),
                model: $this->option('model')
            );

            $this->displayResults($results, $url);
            return 0;
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
            return 1;
        }
    }

    protected function searchSimilarImages(
        array $vector,
        int $limit,
        float $threshold,
        ?string $model = null
    ): object {
        return DB::connection('vectors')
            ->table('image_embeddings')
            ->select([
                'image_embeddings.*',
                DB::raw('embedding <=> ? as distance', [$vector]),
                DB::raw("'image' as embedding_type")
            ])
            ->when($model, function ($query, $model) {
                return $query->where('model_name', $model);
            })
            ->whereNotNull('embedding')
            ->orderBy('distance')
            ->having('distance', '<=', 1 - $threshold)
            ->limit($limit)
            ->get();
    }

    protected function displayResults(object $results, string $searchUrl): void
    {
        $this->info("\nSearch Results:");
        $this->info("---------------");
        $this->info("Query Image: " . $searchUrl);
        $this->info("Total Results: " . $results->count());

        if ($results->isEmpty()) {
            $this->warn("No similar images found.");
            return;
        }

        $table = new Table($this->output);
        $table->setHeaders([
            'ID',
            'Model',
            'Similarity %',
            'Created',
            'Updated'
        ]);

        foreach ($results as $result) {
            $similarity = (1 - $result->distance) * 100;

            $table->addRow([
                $result->model_id,
                $result->model_name,
                number_format($similarity, 2) . '%',
                $result->created_at,
                $result->updated_at
            ]);

            // Show additional data if available
            if (!empty($result->data)) {
                $this->line("\nDetails for ID: " . $result->model_id);
                $data = json_decode($result->data, true);
                foreach ($data as $key => $value) {
                    if (is_string($value)) {
                        $this->line("- {$key}: {$value}");
                    }
                }
            }
        }

        $table->render();
    }
}
