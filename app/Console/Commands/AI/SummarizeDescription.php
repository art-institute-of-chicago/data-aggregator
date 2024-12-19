<?php

namespace App\Console\Commands\AI;

use App\Console\Commands\BaseCommand;
use App\Services\EmbeddingService;
use App\Services\DescriptionService;
use App\Models\Collections\Artwork;
use App\Models\Web\Vectors\ImageEmbedding;
use App\Models\Web\Vectors\TextEmbedding;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Helper\Table;

class SummarizeDescription extends BaseCommand
{
    protected $signature = 'ai:summarize
        {--id= : ID of artwork to analyze}
        {--random : Pick a random artwork with existing embeddings}
        {--compare : Compare multiple summarization attempts}
        {--attempts=3 : Number of summarization attempts for comparison}
        {--save : Save the results to a file}';

    protected $description = 'Generate or update AI-powered artwork descriptions';

    protected EmbeddingService $embeddingService;
    protected DescriptionService $descriptionService;
    protected array $latestResults = [];

    public function __construct(
        EmbeddingService $embeddingService,
        DescriptionService $descriptionService
    ) {
        parent::__construct();
        $this->embeddingService = $embeddingService;
        $this->descriptionService = $descriptionService;
    }

    public function handle(): int
    {
        $this->getAicLogo();

        try {
            // Get artwork and embeddings
            $artwork = $this->option('random') 
                ? $this->getRandomArtwork()
                : Artwork::findOrFail($this->option('id') ?? $this->ask('Enter artwork ID:'));

            $imageEmbedding = ImageEmbedding::where('model_name', 'artworks')
                ->where('model_id', $artwork->id)
                ->first();
            
            $textEmbedding = TextEmbedding::where('model_name', 'artworks')
                ->where('model_id', $artwork->id)
                ->first();

            // Display artwork info
            $this->displayArtworkInfo($artwork, $imageEmbedding);

            // Validate image analysis data exists
            if (!$imageEmbedding?->data['description_generation_data']['analysis_data']) {
                throw new \Exception("No AI analysis data found for artwork {$artwork->id}");
            }

            // Generate new summary
            $newSummary = $this->descriptionService->summarizeImageDescription(
                $artwork->description,
                $imageEmbedding->data['description_generation_data']['analysis_data']
            );

            // Save the new embedding
            $this->embeddingService->saveEmbeddings(
                modelName: "artworks",
                modelId: $artwork->id,
                embedding: $this->embeddingService->getEmbeddings($newSummary),
                type: 'text',
                additionalData: [
                    'description' => $newSummary,
                    'generated_at' => now()->toDateTimeString(),
                    'previous_summary' => $textEmbedding?->data['description'] ?? null,
                ]
            );

            // Display results
            $this->displayGeneratedSummary($newSummary, $textEmbedding);

            // Save results if requested
            if ($this->option('save')) {
                $this->saveResults($artwork, $imageEmbedding, $textEmbedding, $newSummary);
            }

            return 0;
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
            Log::error('AI Summarization error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return 1;
        }
    }

    protected function getRandomArtwork(): Artwork
    {
        $imageEmbedding = ImageEmbedding::where('model_name', 'artworks')
            ->whereNotNull('data->analysis_data')
            ->inRandomOrder()
            ->firstOrFail();

        $artwork = Artwork::findOrFail($imageEmbedding->model_id);
        $this->info("Selected random artwork: {$artwork->id} - {$artwork->title}");
        return $artwork;
    }

    protected function displayArtworkInfo($artwork, $imageEmbedding): void
    {
        $this->info("\nArtwork Information:");
        $this->info("-------------------");

        $table = new Table($this->output);
        $table->setHeaders(['Field', 'Value']);
        $table->addRows([
            ['ID', $artwork->id],
            ['Title', $artwork->title],
            ['Date', $artwork->date_display],
            ['Has AIC Description', !empty($artwork->description) ? 'Yes' : 'No'],
            ['Has AI Analysis', !empty($imageEmbedding?->data['description_generation_data']['analysis_data']) ? 'Yes' : 'No'],
        ]);
        $table->render();

        if ($artwork->description) {
            $this->info("\nAIC Description:");
            $this->line($artwork->description);
        }
    }

    protected function displayGeneratedSummary($newSummary, $textEmbedding): void
    {
        if ($textEmbedding?->data['description']) {
            $this->info("\nPrevious Summary:");
            $this->line($textEmbedding->data['description']);
        }

        $this->info("\nNew Summary Generated and Saved:");
        $this->line($newSummary);

        if ($textEmbedding?->data['description']) {
            similar_text($newSummary, $textEmbedding->data['description'], $percent);
            $this->info("\nSimilarity to previous summary: " . number_format($percent, 2) . '%');
        }
    }

    protected function saveResults($artwork, $imageEmbedding, $textEmbedding, $newSummary): void
    {
        $timestamp = now()->format('Y-m-d_H-i-s');
        $filename = storage_path("app/summaries/artwork_{$artwork->id}_{$timestamp}.json");

        $data = [
            'timestamp' => now()->toISOString(),
            'artwork' => [
                'id' => $artwork->id,
                'title' => $artwork->title,
                'description' => $artwork->description,
            ],
            'embeddings' => [
                'image' => $imageEmbedding?->data,
                'text' => $textEmbedding?->data,
            ],
            'new_summary' => $newSummary,
            'previous_summary' => $textEmbedding?->data['description'] ?? null,
        ];

        if (!is_dir(dirname($filename))) {
            mkdir(dirname($filename), 0755, true);
        }

        file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
        $this->info("\nResults saved to: " . $filename);
    }
}