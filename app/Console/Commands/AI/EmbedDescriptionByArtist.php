<?php

namespace App\Console\Commands\AI;

use App\Console\Commands\BaseCommand;
use App\Models\Collections\Agent;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Output\OutputInterface;

class EmbedDescriptionByArtist extends BaseCommand
{
    protected $signature = 'ai:summarize-artist-artworks {ids* : Artist IDs to process}';

    protected $description = 'Summarizes descriptions of artworks for specified artists';

    public function handle(): int
    {
        $this->info($this->getAicLogo(), OutputInterface::VERBOSITY_VERBOSE);

        // Artist IDs are now required
        $artistIds = $this->argument('ids');

        if (empty($artistIds)) {
            $this->error('Artist IDs required.');
            return self::FAILURE;
        }

        $this->info("Processing " . count($artistIds) . " artists...", OutputInterface::VERBOSITY_VERBOSE);
        $this->newLine();

        $processedCount = 0;
        $artworkCount = 0;

        foreach ($artistIds as $id) {
            $artist = Agent::with(['webArtist', 'createdArtworks'])->find($id);

            if (!$artist) {
                $this->warn("Artist with ID {$id} not found.", OutputInterface::VERBOSITY_VERBOSE);
                continue;
            }

            $artworks = $artist->createdArtworks;

            if ($artworks->isEmpty()) {
                $this->info("Artist ({$id}) {$artist->title} has no artworks.", OutputInterface::VERBOSITY_VERBOSE);
                continue;
            }

            $this->info("Processing artist ({$id}) {$artist->title} ({$artworks->count()} artworks)", OutputInterface::VERBOSITY_VERBOSE);

            $artistArtworkCount = 0;

            foreach ($artworks as $artwork) {
                $this->info("Processing: (ID: {$artwork->id}) | {$artwork->title}", OutputInterface::VERBOSITY_VERBOSE);

                try {
                    Artisan::call('ai:summarize', [
                        '--id' => $artwork->id,
                    ]);

                    $artworkCount++;

                    $this->info("  Summarized successfully", OutputInterface::VERBOSITY_VERBOSE);
                } catch (\Exception $e) {
                    $this->error("Failed to summarize artwork ({$artwork->id}) {$artwork->title}: " . $e->getMessage());
                }

                $artistArtworkCount++;
                $this->info("  Summarized {$artistArtworkCount} of {$artworks->count()}", OutputInterface::VERBOSITY_VERBOSE);
            }

            $processedCount++;
            $this->newLine();
        }

        $this->info("Summarization complete!", OutputInterface::VERBOSITY_VERBOSE);
        $this->info("Statistics:", OutputInterface::VERBOSITY_VERBOSE);
        $this->info("  Artists processed: {$processedCount}", OutputInterface::VERBOSITY_VERBOSE);
        $this->info("  Artworks summarized: {$artworkCount}", OutputInterface::VERBOSITY_VERBOSE);

        return self::SUCCESS;
    }
}
