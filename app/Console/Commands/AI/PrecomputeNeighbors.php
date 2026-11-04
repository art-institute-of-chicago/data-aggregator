<?php

namespace App\Console\Commands\AI;

use App\Console\Commands\BaseCommand;
use App\Models\Web\Vectors\EmbeddingNeighbor;
use App\Models\Web\Vectors\ImageEmbedding;
use App\Models\Web\Vectors\TextEmbedding;
use App\Services\VectorSearchService;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Output\OutputInterface;

class PrecomputeNeighbors extends BaseCommand
{
    protected $signature = 'ai:precompute-neighbors
        {model=artworks : Model name to precompute (artworks, articles, highlights, all)}
        {--type=both : Embedding type to precompute (text, image, both)}
        {--limit=25 : Neighbors to store per item}
        {--chunk=250 : Embedding rows processed per batch}
        {--id= : Only precompute for this model_id}
        {--fresh : Delete existing rows for this model + type first}
        {--prune : Delete rows pointing at embeddings that no longer exist}';

    protected $description = 'Materialize nearest neighbors into embedding_neighbors for fast reads';

    public function __construct(
        protected VectorSearchService $searchService
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $models = $this->getModels();
        $types = $this->getTypes();
        $limit = (int) $this->option('limit');
        $chunk = max(1, (int) $this->option('chunk'));

        if ($limit < 1) {
            $this->error('--limit must be at least 1');
            return 1;
        }

        foreach ($models as $model) {
            foreach ($types as $type) {
                if ($this->option('prune')) {
                    $deleted = $this->searchService->pruneNeighbors($type, $model);
                    $this->info(
                        "Pruned {$deleted} stale {$type} rows for {$model}.",
                        OutputInterface::VERBOSITY_VERBOSE
                    );
                }

                $this->precompute($model, $type, $limit, $chunk);
            }
        }

        return 0;
    }

    protected function precompute(
        string $model,
        string $type,
        int $limit,
        int $chunk
    ): void {
        $embeddingClass = $type === 'image' ? ImageEmbedding::class : TextEmbedding::class;

        $query = fn () => $embeddingClass::query()
            ->select(['id', 'model_name', 'model_id', 'embedding'])
            ->where('model_name', $model)
            ->whereNotNull('embedding')
            ->when($this->option('id'), fn ($q, $id) => $q->where('model_id', (int) $id));

        if ($this->option('fresh')) {
            $deleted = EmbeddingNeighbor::where('embedding_type', $type)
                ->where('model_name', $model)
                ->delete();

            $this->info("Cleared {$deleted} existing {$type} rows for {$model}.", OutputInterface::VERBOSITY_VERBOSE);
        }

        $total = $query()->count();

        if ($total === 0) {
            $this->warn("No {$type} embeddings for {$model}, skipping.", OutputInterface::VERBOSITY_VERBOSE);

            return;
        }

        $this->info(
            "Precomputing {$limit} {$type} neighbors for {$total} {$model} items...",
            OutputInterface::VERBOSITY_VERBOSE
        );

        $processed = 0;
        $failed = 0;

        $query()->chunkById(
            $chunk,
            function ($rows) use ($embeddingClass, $type, $model, $limit, &$processed, &$failed) {
                // One transaction for the whole batch instead of one per item.
                $this->searchService->withSearchSettings(
                    function () use ($rows, $embeddingClass, $type, $model, $limit, &$processed, &$failed) {
                        foreach ($rows as $row) {
                            try {
                                $neighbors = $this->searchService->liveNearestNeighbors(
                                    $embeddingClass,
                                    (string) $row->embedding,
                                    $model,
                                    $row->model_id,
                                    $limit,
                                    applySearchSettings: false
                                );

                                $this->searchService->storeNeighbors(
                                    $type,
                                    $model,
                                    (int) $row->model_id,
                                    $neighbors,
                                    $limit
                                );

                                $processed++;
                            } catch (\Throwable $e) {
                                $failed++;

                                Log::warning('ai:precompute-neighbors failed for item', [
                                    'embedding_type' => $type,
                                    'model_name' => $model,
                                    'model_id' => $row->model_id,
                                    'message' => $e->getMessage(),
                                ]);
                            }
                        }
                    },
                    (int) config('vector.ef_search', 100)
                );
            }
        );

        $this->info("Done: {$processed} {$model} items, {$failed} failures.", OutputInterface::VERBOSITY_VERBOSE);

        if ($failed > 0) {
            $this->warn('Some items were skipped. Check the log for details.', OutputInterface::VERBOSITY_VERBOSE);
        }
    }

    /**
     * @return array<int, string>
     */
    protected function getModels(): array
    {
        $model = (string) $this->argument('model');

        if ($model === 'all') {
            return ['artworks', 'articles', 'highlights'];
        }

        return [$model];
    }

    /**
     * @return array<int, string>
     */
    protected function getTypes(): array
    {
        $type = (string) $this->option('type');

        if ($type === 'both') {
            return ['text', 'image'];
        }

        if (!in_array($type, ['text', 'image'], true)) {
            throw new \InvalidArgumentException('--type must be one of: text, image, both');
        }

        return [$type];
    }
}
