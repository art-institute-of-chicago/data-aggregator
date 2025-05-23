<?php

namespace App\Console\Commands\AI;

use App\Behaviors\HandleEmbeddings;
use App\Console\Commands\BaseCommand;
use App\Services\DescriptionService;
use App\Models\Collections\Artwork;
use App\Models\Web\Vectors\ImageEmbedding;
use App\Models\Web\Vectors\TextEmbedding;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Output\OutputInterface;

class UseCompletions extends BaseCommand
{
    use HandleEmbeddings;

    protected $signature = 'ai:chat
        {query? : A question to ask chat}
        {--mode=chat : Mode of operation (chat, summarize)}
        {--id= : ID of artwork to analyze}
        {--compare : Compare multiple summarization attempts}
        {--attempts=3 : Number of summarization attempts for comparison}
        {--save : Save the results to a file}
        {--random : Pick a random artwork with existing embeddings}
        {--generate : Generate a new summary and save it}';

    protected $description = 'Interactive AI completions and description summarization tool';

    protected DescriptionService $descriptionService;

    public function __construct(
        DescriptionService $descriptionService
    ) {
        parent::__construct();
        $this->descriptionService = $descriptionService;
    }

    public function handle(): int
    {
        $this->info($this->getAicLogo(), OutputInterface::VERBOSITY_VERBOSE);

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
                $imageEmbedding?->data['description_generation_data']['analysis_data'] ?? [],
                (int) $this->option('attempts')
            );
        } else {
            $summary = $this->descriptionService->summarizeImageDescription(
                $artwork->description,
                $imageEmbedding?->data['description_generation_data']['analysis_data'] ?? []
            );

            $this->displaySummary(
                $summary,
                $artwork->description,
                $imageEmbedding?->data['description_generation_data']['analysis_data'] ?? []
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
            ->whereNotNull('data->description_generation_data->analysis_data')
            ->inRandomOrder()
            ->firstOrFail();

        $artwork = Artwork::findOrFail($imageEmbedding->model_id);

        $this->info("Selected random artwork: {$artwork->id} - {$artwork->title}", OutputInterface::VERBOSITY_VERBOSE);

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
        $this->info("\nGenerating new summary...", OutputInterface::VERBOSITY_VERBOSE);

        if (!$imageEmbedding?->data['description_generation_data']['analysis_data']) {
            throw new \Exception("No AI analysis data found for artwork {$artwork->id}");
        }

        $newSummary = $this->descriptionService->summarizeImageDescription(
            $artwork->description,
            $imageEmbedding->data['description_generation_data']['analysis_data']
        );

        // Save to both image and text embeddings
        $imageData = $imageEmbedding->data;
        $imageData['description'] = $newSummary;
        $imageData['generated_at'] = now()->toDateTimeString();

        // Convert Vector to array for image embedding
        $embeddingArray = $imageEmbedding->embedding ? $imageEmbedding->embedding->toArray() : [];

        $this->saveEmbeddings(
            modelName: "artworks",
            modelId: $artwork->id,
            embedding: $embeddingArray,
            type: 'image',
            additionalData: $imageData
        );

        // Update or create text embedding
        $this->saveEmbeddings(
            modelName: "artworks",
            modelId: $artwork->id,
            embedding: app('Embeddings')->getEmbeddings($newSummary),
            type: 'text',
            additionalData: [
                'description' => $newSummary,
                'generated_at' => now()->toDateTimeString(),
                'previous_summary' => $textEmbedding?->data['description'] ?? null,
            ]
        );

        $this->info("\nNew Summary Generated and Saved:", OutputInterface::VERBOSITY_VERBOSE);
        $this->line($newSummary, OutputInterface::VERBOSITY_VERBOSE);

        if ($textEmbedding?->data['description']) {
            $this->info("\nPrevious Summary:", OutputInterface::VERBOSITY_VERBOSE);
            $this->line($textEmbedding->data['description'], OutputInterface::VERBOSITY_VERBOSE);

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

        $this->table(
            ['Field', 'Value'],
            [
                ['ID', $artwork->id],
                ['Title', $artwork->title],
                ['Date', $artwork->date_display],
                ['Has Image Embedding', $imageEmbedding ? 'Yes' : 'No'],
                ['Has Text Embedding', $textEmbedding ? 'Yes' : 'No'],
                ['Has AIC Description', !empty($artwork->description) ? 'Yes' : 'No'],
                ['Has AI Analysis', !empty($imageEmbedding?->data['description_generation_data']['analysis_data']) ? 'Yes' : 'No'],
            ]
        );

        if ($artwork->description) {
            $this->info("\nAIC Description:");
            $this->line($artwork->description);
        }

        if ($imageEmbedding?->data['description_generation_data']['analysis_data']) {
            $this->info("\nAI Analysis Data:");
            $this->line(json_encode($imageEmbedding?->data['description_generation_data']['analysis_data'], JSON_PRETTY_PRINT));
        }
    }

    protected function compareSummarizations(
        ?string $originalDescription,
        array $generatedDescription,
        int $attempts
    ): void {
        $this->info("\nGenerating {$attempts} different summarizations for comparison...", OutputInterface::VERBOSITY_VERBOSE);

        $summaries = [];
        for ($i = 0; $i < $attempts; $i++) {
            $this->line("\nAttempt " . ($i + 1) . "...", OutputInterface::VERBOSITY_VERBOSE);
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
        $this->table(
            ['Source', 'Length'],
            [
                ['AIC Description', $originalDescription ? strlen($originalDescription) : 0],
                ['AI Analysis', strlen(json_encode($generatedDescription))],
                ['Summarized', strlen($summary)],
            ]
        );
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

        $tableResults = [];
        for ($i = 0; $i < count($summaries); $i++) {
            for ($j = $i + 1; $j < count($summaries); $j++) {
                $similarity = $this->calculateSimilarity($summaries[$i], $summaries[$j]);
                $tableResults[] = [
                    "Version " . ($i + 1) . " vs " . ($j + 1),
                    number_format($similarity * 100, 2) . '%'
                ];
            }
        }

        $this->table(
            ['Comparison', 'Similarity %'],
            $tableResults
        );
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
        $response = app('Embeddings')->getCompletions($query);

        $this->info("\nResponse:");
        $this->line($response);

        return 0;
    }
}
