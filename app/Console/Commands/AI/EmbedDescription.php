<?php

namespace App\Console\Commands\AI;

use App\Behaviors\HandleEmbeddings;
use App\Console\Commands\BaseCommand;
use App\Models\Web\Vectors\TextEmbedding;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\OutputInterface;
use Exception;

class EmbedDescription extends BaseCommand
{
    use HandleEmbeddings;

    protected $signature = 'ai:embed-description {model_name? : The name of the model (e.g., artworks)}
                                                 {model_id? : The ID of the model instance}
                                                 {--reindex : Regenerate the index on the text_embeddings table}';

    protected $description = 'Re-embeds the description for a specific model instance';

    public function handle(): int
    {
        try {
            if ($this->argument('model_name') || $this->argument('model_id')) {
                $items = [
                  (object) [
                      'model_name' => $this->argument('model_name'),
                      'model_id'   => $this->argument('model_id'),
                  ],
                ];
            } else {
                $items = DB::connection('vectors')
                  ->table('embedding_updates')
                  ->where('created_at', '>', now()->subMinute())
                  ->get();
            }

            if ($items) {
                foreach ($items as $item) {
                    $modelName = $item->model_name;
                    $modelId = $item->model_id;

                    if (!$modelName || !$modelId) {
                        $this->error('The model_name and model_id are required', OutputInterface::VERBOSITY_VERBOSE);
                        return 1;
                    }

                    $this->info("Looking for TextEmbedding record for model [{$modelName}] with ID [{$modelId}]...", OutputInterface::VERBOSITY_VERBOSE);

                    $textEmbeddingRecord = TextEmbedding::where('model_name', $modelName)
                    ->where('model_id', $modelId)
                    ->first();

                    if (!$textEmbeddingRecord) {
                        $this->error("No TextEmbedding record found for model [{$modelName}] with ID [{$modelId}].", OutputInterface::VERBOSITY_VERBOSE);
                        return 1;
                    }

                    $descriptionText = $textEmbeddingRecord->data['description'] ?? null;

                    if (empty(trim($descriptionText))) {
                        $this->info("Description in the embedding record is empty. Nothing to re-embed.", OutputInterface::VERBOSITY_VERBOSE);
                        return 0;
                    }

                    $this->info("Found existing description. Re-generating text embedding...", OutputInterface::VERBOSITY_VERBOSE);

                    $newEmbeddingVector = app('Embeddings')->getEmbeddings($descriptionText);

                    if (!$newEmbeddingVector || !is_array($newEmbeddingVector)) {
                        $this->error("Failed to generate new embeddings from description text.", OutputInterface::VERBOSITY_VERBOSE);
                        return 1;
                    }

                    $this->info("Embeddings re-generated successfully. Updating the record in the database...", OutputInterface::VERBOSITY_VERBOSE);

                    $this->saveEmbeddings(
                        modelName: $modelName,
                        modelId: $modelId,
                        embedding: $newEmbeddingVector,
                        type: 'text',
                        additionalData: [
                        'description' => $descriptionText,
                        'generated_at' => now()->toDateTimeString(),
                        'image_url' => $textEmbeddingRecord->data['image_url'] ?? null
                        ]
                    );

                    $this->info("Successfully updated text embeddings for model [{$modelName}] ID [{$modelId}].", OutputInterface::VERBOSITY_VERBOSE);

                    $this->info('Re-indexing the text_embeddings table...', OutputInterface::VERBOSITY_VERBOSE);
                    DB::connection('vectors')->statement('VACUUM ANALYZE text_embeddings;');
                    $this->info('Table has been successfully re-indexed.', OutputInterface::VERBOSITY_VERBOSE);

                    return 0;
                }
            }
        } catch (Exception $e) {
            $this->error("An error occurred: " . $e->getMessage());
            return 1;
        }
        return 1;
    }
}
