<?php

namespace App\Console\Commands\AI;

use App\Behaviors\HandleEmbeddings;
use App\Console\Commands\BaseCommand;
use App\Services\VectorSearchService;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\OutputInterface;

class ImageSearch extends BaseCommand
{
    use HandleEmbeddings;

    protected $signature = 'ai:search-image
        {url? : URL of the image to search}
        {--limit=10 : Number of results to return}
        {--threshold=0.8 : Similarity threshold (0-1)}
        {--model= : Specific model to search (artworks, articles, exhibitions)}';

    protected $description = 'Search for similar images using vector embeddings';

    protected VectorSearchService $searchService;

    public function __construct(
        VectorSearchService $searchService
    ) {
        parent::__construct();
        $this->searchService = $searchService;
    }

    public function handle(): int
    {
        $this->info($this->getAicLogo(), OutputInterface::VERBOSITY_VERBOSE);

        try {
            // Get image URL
            $url = $this->argument('url') ?? $this->ask('Enter the image URL to search:');
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                throw new \Exception('Invalid URL provided');
            }

            $this->info("\nFetching image embeddings...", OutputInterface::VERBOSITY_VERBOSE);
            $vector = app('Embeddings')->getImageEmbeddings($url);

            $this->info("Searching for similar images...", OutputInterface::VERBOSITY_VERBOSE);
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

        $tableResults = $results->map(function ($item, $index) {
            // Show additional data if available
            if (!empty($item->data)) {
                $this->line("\nDetails for ID: " . $item->model_id);
                $data = json_decode($item->data, true);
                foreach ($data as $key => $value) {
                    if (is_string($value)) {
                        $this->line("- {$key}: {$value}");
                    }
                }
            }

            $similarity = (1 - $item->distance) * 100;
            return [
                $item->model_id,
                $item->model_name,
                number_format($similarity, 2) . '%',
                $item->created_at,
                $item->updated_at
            ];
        })->toArray();

        $this->table(
            [
                'ID',
                'Model',
                'Similarity %',
                'Created',
                'Updated'
            ],
            $tableResults
        );
    }
}
