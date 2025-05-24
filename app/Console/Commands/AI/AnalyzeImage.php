<?php

namespace App\Console\Commands\AI;

use App\Behaviors\HandleEmbeddings;
use App\Console\Commands\BaseCommand;
use App\Services\DescriptionService;
use App\Models\Collections\Artwork;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Output\OutputInterface;
use Exception;

class AnalyzeImage extends BaseCommand
{
    use HandleEmbeddings;

    protected $signature = 'ai:analyze {id? : Artwork ID to analyze}';
    protected $description = 'Analyze an artwork using AI for descriptions and embeddings';

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
            $artwork = $this->getArtwork();
            $imageUrl = $this->buildImageUrl($artwork);

            $this->info("Analyzing artwork: {$artwork->title}", OutputInterface::VERBOSITY_VERBOSE);
            $this->info("Image URL: {$imageUrl}", OutputInterface::VERBOSITY_VERBOSE);

            // Get and save image analysis
            $analysisResults = $this->analyzeImage($artwork, $imageUrl);

            // Process and save embeddings
            $this->processEmbeddings($artwork, $imageUrl, $analysisResults);

            $this->info("\nAnalysis completed successfully!", OutputInterface::VERBOSITY_VERBOSE);
            $this->table(
                ['Component', 'Status'],
                [
                    ['Image Analysis', '✓'],
                    ['Image Embeddings', '✓'],
                    ['Text Embeddings', '✓'],
                    ['Description', '✓']
                ]
            );

            return 0;
        } catch (Exception $e) {
            $this->error("Error: " . $e->getMessage());
            Log::error('AI Analysis error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return 1;
        }
    }

    protected function getArtwork(): Artwork
    {
        $id = $this->argument('id') ?? $this->ask('What is the datahub_id of the artwork to process?');

        $artwork = Artwork::find($id);
        if (!$artwork) {
            throw new Exception("Artwork with ID {$id} not found.");
        }

        return $artwork;
    }
}
