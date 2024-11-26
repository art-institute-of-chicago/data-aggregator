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

class UseCompletions extends BaseCommand
{
    protected $signature = 'ai:chat 
        {--mode=chat : Mode of operation (chat, summarize)}
        {--id= : ID of artwork to analyze}
        {--compare : Compare multiple summarization attempts}
        {--attempts=3 : Number of summarization attempts for comparison}
        {--save : Save the results to a file}
        {--random : Pick a random artwork with existing embeddings}
        {--generate : Generate a new summary and save it}';

    protected $description = 'Interactive AI completions and description summarization tool';

    protected EmbeddingService $embeddingService;
    protected DescriptionService $descriptionService;

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
            $mode = $this->option('mode');

            if ($mode === 'summarize') {
                return $this->handleSummarization();
            }

            return $this->handleChatCompletion();
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
            Log::error('AI Completion error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return 1;
        }
    }

    protected function handleSummarization(): int
    {
        $artwork = $this->getArtwork();
        $imageEmbedding = $this->getImageEmbedding($artwork->id);
        $textEmbedding = $this->getTextEmbedding($artwork->id);

        $this->displayArtworkInfo($artwork, $imageEmbedding, $textEmbedding);

        if ($this->option('generate')) {
            $this->generateNewSummary($artwork, $imageEmbedding, $textEmbedding);
            return 0;
        }

        if ($this->option('compare')) {
            $this->compareSummarizations(
                $artwork->description,
                $imageEmbedding?->data['analysis_data'] ?? [],
                (int) $this->option('attempts')
            );
        } else {
            $summary = $this->descriptionService->summarizeImageDescription(
                $artwork->description,
                $imageEmbedding?->data['analysis_data'] ?? []
            );

            $this->displaySummary(
                $summary,
                $artwork->description,
                $imageEmbedding?->data['analysis_data'] ?? []
            );
        }

        if ($this->option('save')) {
            $this->saveResults($artwork, $imageEmbedding, $textEmbedding);
        }

        return 0;
    }

    protected function getArtwork(): Artwork
    {
        if ($this->option('random')) {
            return $this->getRandomArtwork();
        }

        $id = $this->option('id') ?? $this->ask('Enter artwork ID:');

        $artwork = Artwork::find($id);
        if (!$artwork) {
            throw new \Exception("Artwork with ID {$id} not found.");
        }

        return $artwork;
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

    protected function getImageEmbedding(int $artworkId): ?ImageEmbedding
    {
        return ImageEmbedding::where('model_name', 'artworks')
            ->where('model_id', $artworkId)
            ->first();
    }

    protected function getTextEmbedding(int $artworkId): ?TextEmbedding
    {
        return TextEmbedding::where('model_name', 'artworks')
            ->where('model_id', $artworkId)
            ->first();
    }

    protected function generateNewSummary(
        Artwork $artwork,
        ?ImageEmbedding $imageEmbedding,
        ?TextEmbedding $textEmbedding
    ): void {
        $this->info("\nGenerating new summary...");

        if (!$imageEmbedding?->data['analysis_data']) {
            throw new \Exception("No AI analysis data found for artwork {$artwork->id}");
        }

        $newSummary = $this->descriptionService->summarizeImageDescription(
            $artwork->description,
            $imageEmbedding->data['analysis_data']
        );

        // Update or create text embedding with new summary
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

        $this->info("\nNew Summary Generated and Saved:");
        $this->line($newSummary);

        if ($textEmbedding?->data['description']) {
            $this->info("\nPrevious Summary:");
            $this->line($textEmbedding->data['description']);

            $similarity = $this->calculateSimilarity(
                $newSummary,
                $textEmbedding->data['description']
            );

            $this->info("\nSimilarity to previous summary: " .
                number_format($similarity * 100, 2) . '%');
        }
    }

    protected function displayArtworkInfo(
        Artwork $artwork,
        ?ImageEmbedding $imageEmbedding,
        ?TextEmbedding $textEmbedding
    ): void {
        $this->info("\nArtwork Information:");
        $this->info("-------------------");

        $table = new Table($this->output);
        $table->setHeaders(['Field', 'Value']);
        $table->addRows([
            ['ID', $artwork->id],
            ['Title', $artwork->title],
            ['Date', $artwork->date_display],
            ['Has Image Embedding', $imageEmbedding ? 'Yes' : 'No'],
            ['Has Text Embedding', $textEmbedding ? 'Yes' : 'No'],
            ['Has AIC Description', !empty($artwork->description) ? 'Yes' : 'No'],
            ['Has AI Analysis', !empty($imageEmbedding?->data['analysis_data']) ? 'Yes' : 'No'],
        ]);
        $table->render();

        if ($artwork->description) {
            $this->info("\nAIC Description:");
            $this->line($artwork->description);
        }

        if ($imageEmbedding?->data['analysis_data']) {
            $this->info("\nAI Analysis Data:");
            $this->line(json_encode($imageEmbedding?->data['analysis_data'], JSON_PRETTY_PRINT));
        }
    }

    protected function compareSummarizations(
        ?string $originalDescription,
        array $generatedDescription,
        int $attempts
    ): void {
        $this->info("\nGenerating {$attempts} different summarizations for comparison...");

        $summaries = [];
        for ($i = 0; $i < $attempts; $i++) {
            $this->line("\nAttempt " . ($i + 1) . "...");
            $summaries[] = $this->descriptionService->summarizeImageDescription(
                $originalDescription,
                $generatedDescription
            );
        }

        $this->displayComparison($summaries, $originalDescription, $generatedDescription);
    }

    protected function displaySummary(
        string $summary,
        ?string $originalDescription,
        array $generatedDescription
    ): void {
        $this->info("\nSummarization Results:");
        $this->info("---------------------");

        if ($originalDescription) {
            $this->info("\nOriginal AIC Description:");
            $this->line($originalDescription);
        }

        $this->info("\nGenerated AI Description Data:");
        $this->line(json_encode($generatedDescription, JSON_PRETTY_PRINT));

        $this->info("\nSummarized Description:");
        $this->line($summary);

        $this->info("\nCharacter Counts:");
        $table = new Table($this->output);
        $table->setHeaders(['Source', 'Length']);
        $table->addRows([
            ['AIC Description', $originalDescription ? strlen($originalDescription) : 0],
            ['AI Analysis', strlen(json_encode($generatedDescription))],
            ['Summarized', strlen($summary)],
        ]);
        $table->render();
    }

    protected function displayComparison(array $summaries, ?string $originalDescription, array $generatedDescription): void
    {
        $this->info("\nComparison Results:");
        $this->info("------------------");

        foreach ($summaries as $index => $summary) {
            $this->info("\nVersion " . ($index + 1) . ":");
            $this->line($summary);
            $this->line("\nLength: " . strlen($summary) . " characters");
        }

        $this->info("\nSimilarity Analysis:");
        $table = new Table($this->output);
        $table->setHeaders(['Comparison', 'Similarity %']);

        for ($i = 0; $i < count($summaries); $i++) {
            for ($j = $i + 1; $j < count($summaries); $j++) {
                $similarity = $this->calculateSimilarity($summaries[$i], $summaries[$j]);
                $table->addRow([
                    "Version " . ($i + 1) . " vs " . ($j + 1),
                    number_format($similarity * 100, 2) . '%'
                ]);
            }
        }

        $table->render();
    }

    protected function calculateSimilarity(string $text1, string $text2): float
    {
        similar_text($text1, $text2, $percent);
        return $percent / 100;
    }

    protected function saveResults(
        Artwork $artwork,
        ?ImageEmbedding $imageEmbedding,
        ?TextEmbedding $textEmbedding
    ): void {
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
            'summaries' => $this->latestResults ?? [],
            'metadata' => [
                'mode' => $this->option('mode'),
                'attempts' => $this->option('attempts'),
            ]
        ];

        if (!is_dir(dirname($filename))) {
            mkdir(dirname($filename), 0755, true);
        }

        file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
        $this->info("\nResults saved to: " . $filename);
    }

    protected function handleChatCompletion(): int
    {
        $query = $this->argument('query') ?? $this->ask('Type a chat query:');
        $response = $this->embeddingService->getCompletions($query);

        $this->info("\nResponse:");
        $this->line($response);

        return 0;
    }
}
