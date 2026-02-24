<?php

namespace App\Console\Commands\AI;

use App\Behaviors\HandleEmbeddings;
use App\Console\Commands\BaseCommand;
use App\Models\Collections\Artwork;
use App\Models\Web\Vectors\TextEmbedding;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\Console\Output\OutputInterface;

class EmbedMetaDataToArtworks extends BaseCommand
{
    use HandleEmbeddings;

    protected $signature = 'ai:add-metadata-artworks {--start-id= : Start Artwork ID to process from}';
    protected $description = 'Adds meta data to AI artwork descriptions';

    public function handle()
    {
        $startId = $this->option('start-id') ?? 0;

        $query = TextEmbedding::where('id', '>=', $startId);
        $totalCount = $query->count();

        $this->info("Processing " . $totalCount . " embeddings...", OutputInterface::VERBOSITY_VERBOSE);

        $query->chunk(200, function (Collection $embeddings) {
            foreach ($embeddings as $embedding) {
                $artwork = Artwork::where('id', $embedding->model_id)->first();

                if (!$artwork) {
                    $this->info("Artwork not found for embedding ID: {$embedding->id}", OutputInterface::VERBOSITY_VERBOSE);
                    continue;
                }

                $artistName = $artwork->artist ? $artwork->artist->title :
                            ($artwork->artists->first() ? $artwork->artists->first()->title : '');

                $descriptionText = "{$artistName}";
                $descriptionText .= " | {$artwork->title}";
                $descriptionText .= " | " . ($artwork->style ? $artwork->style?->title : '');
                $descriptionText .= " | " . $embedding->data['description'];

                $this->info("Processing artwork: {$artwork->title} by {$artistName} ({$artwork->id})", OutputInterface::VERBOSITY_VERBOSE);

                $this->saveEmbeddings(
                    modelName: $embedding->model_name,
                    modelId: $embedding->model_id,
                    embedding: app('Embeddings')->getEmbeddings($descriptionText),
                    type: 'text',
                    additionalData: [
                        'description' => $descriptionText,
                        'generated_at' => now()->toDateTimeString(),
                        'image_url' => $embedding->data['image_url'] ?? null
                    ]
                );
            }
        });

        $this->info("Metadata processing completed!", OutputInterface::VERBOSITY_VERBOSE);
    }
}
