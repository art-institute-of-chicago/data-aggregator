<?php

namespace App\Console\Commands\AI;

use App\Behaviors\HandleEmbeddings;
use App\Behaviors\Thresholds;
use App\Console\Commands\BaseCommand;
use App\Services\DescriptionService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\OutputInterface;
use Exception;

class GenerateAltText extends BaseCommand implements Thresholds
{
    use HandleEmbeddings;

    protected $signature = 'ai:generate-alt-text
                            {model_name? : The morph name of the model (e.g., digitalPublications)}
                            {model_id? : The ID of the model instance}
                            {--mediables : Process only mediables}
                            {--blocks : Process only image blocks}
                            {--force : Regenerate alt text even if it exists}';

    protected $description = 'Generate a visual description for use in alt text';

    public function handle(): int
    {
        try {
            $this->info($this->getAicLogo(), OutputInterface::VERBOSITY_VERBOSE);

            $processedCount = 0;

            // Determine which processing mode to use
            if ($this->option('mediables') && !$this->option('blocks')) {
                // Only mediables
                if ($this->argument('model_name') && $this->argument('model_id')) {
                    $processedCount = $this->processSpecificModel(
                        $this->argument('model_name'),
                        $this->argument('model_id')
                    );
                } else {
                    $processedCount = $this->processAllMediables();
                }
            } elseif ($this->option('blocks') && !$this->option('mediables')) {
                // Only blocks
                $processedCount = $this->processImageBlocks(
                    $this->argument('model_name'),
                    $this->argument('model_id')
                );
            } else {
                // Default: both mediables and blocks
                if ($this->argument('model_name') && $this->argument('model_id')) {
                    $processedCount += $this->processSpecificModel(
                        $this->argument('model_name'),
                        $this->argument('model_id')
                    );
                    $processedCount += $this->processImageBlocks(
                        $this->argument('model_name'),
                        $this->argument('model_id')
                    );
                } else {
                    $processedCount += $this->processAllMediables();
                    $processedCount += $this->processImageBlocks(null, null);
                }
            }

            $this->line("Processing complete. Total processed: {$processedCount}", OutputInterface::VERBOSITY_VERBOSE);

            return self::SUCCESS;
        } catch (Exception $e) {
            $this->error('Error: ' . $e->getMessage(), OutputInterface::VERBOSITY_VERBOSE);
            Log::error('GenerateAltText command failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return self::FAILURE;
        }
    }

    protected function processSpecificModel(string $modelName, int $modelId): int
    {
        $mediables = DB::connection('website')
            ->table('mediables')
            ->where('mediable_type', $modelName)
            ->where('mediable_id', $modelId)
            ->get();

        if ($mediables->isEmpty()) {
            return 0;
        }

        return $this->processMediables($mediables);
    }

    protected function processAllMediables(): int
    {
        $this->line('Searching for all mediables without alt text...', OutputInterface::VERBOSITY_VERBOSE);

        $query = DB::connection('website')
            ->table('mediables')
            ->leftJoin('medias', 'mediables.media_id', '=', 'medias.id')
            ->select('mediables.*')
            ->whereNull('medias.alt_text');

        if (!$this->option('force')) {
            $query->orWhere('medias.alt_text', '=', '');
        }

        $mediables = $query->get();

        if ($mediables->isEmpty()) {
            $this->info('✨ All media already have alt text!', OutputInterface::VERBOSITY_VERBOSE);
            return 0;
        }


        return $this->processMediables($mediables);
    }

    protected function processMediables($mediables): int
    {
        $this->info("Found {$mediables->count()} media item(s) to process", OutputInterface::VERBOSITY_VERBOSE);

        $progressBar = $this->output->createProgressBar($mediables->count());
        $progressBar->start();

        $processedCount = 0;


        foreach ($mediables as $mediable) {
            try {
                $media = DB::connection('website')
                    ->table('medias')
                    ->where('id', $mediable->media_id)
                    ->first();

                if (!$media) {
                    $this->newLine();
                    $this->warn("⚠️  Media #{$mediable->media_id} not found, skipping...", OutputInterface::VERBOSITY_VERBOSE);
                    $progressBar->advance();
                    continue;
                }

                // Check if alt text exists and we're not forcing
                if (!empty($media->alt_text) && !$this->option('force')) {
                    $this->newLine();
                    $this->line("Media #{$media->id} already has alt text, skipping...", OutputInterface::VERBOSITY_VERBOSE);
                    $progressBar->advance();
                    continue;
                }

                $url = 'https://artic-web.imgix.net/' . $media->uuid;

                $this->analyzeAndStoreImage($media, $url);

                $processedCount++;
            } catch (Exception $e) {
                $this->newLine();
                $this->error("Failed to process media #{$mediable->media_id}: " . $e->getMessage(), OutputInterface::VERBOSITY_VERBOSE);

                Log::error('Failed to generate alt text', [
                    'media_id' => $mediable->media_id,
                    'error' => $e->getMessage()
                ]);
            }

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine();

        return $processedCount;
    }

    protected function analyzeAndStoreImage($media, string $url): void
    {
        $this->line("  Analyzing image: {$url}", OutputInterface::VERBOSITY_VERBOSE);

        // Call the description service to analyze the image
        $analysis = $this->getLLMImageDescription($url);

        if (empty($analysis['caption'])) {
            throw new Exception('No caption generated from analysis');
        }

        // Store the alt text (caption) in the database
        DB::connection('website')
            ->table('medias')
            ->where('id', $media->id)
            ->update([
                'alt_text' => $analysis['caption'],
                'updated_at' => now()
            ]);

        // Tag it as AI generated
        $tagId = DB::connection('website')
            ->table('tags')
            ->where('slug', 'ai-generated-alt-text')
            ->value('id');

        if ($tagId) {
            $tagExists = DB::connection('website')
                ->table('tagged')
                ->where('taggable_type', 'media')
                ->where('taggable_id', $media->id)
                ->where('tag_id', $tagId)
                ->exists();

            if (!$tagExists) {
                DB::connection('website')
                    ->table('tagged')
                    ->insert([
                        'taggable_type' => 'media',
                        'taggable_id' => $media->id,
                        'tag_id' => $tagId,
                    ]);
            }
        }

        $this->line("Alt text generated for media #{$media->id}\n", OutputInterface::VERBOSITY_VERBOSE);
        $this->line("Description:\n\n{$analysis['caption']}\n", OutputInterface::VERBOSITY_VERBOSE);
    }

    protected function processImageBlocks($modelName, $modelId): int
    {
        $this->line('🔍 Searching for image blocks...', OutputInterface::VERBOSITY_VERBOSE);

        $allBlocks = collect([]);

        // 1. Direct Image Blocks
        $imageBlockQuery = DB::connection('website')
            ->table('blocks')
            ->join('mediables', function ($join) {
                $join->on('blocks.id', '=', 'mediables.mediable_id')
                     ->where('mediables.mediable_type', '=', 'blocks');
            })
            ->join('medias', 'mediables.media_id', '=', 'medias.id')
            ->where('blocks.blockable_type', $modelName)
            ->where('blocks.blockable_id', $modelId)
            ->where('blocks.type', 'image')
            ->select('blocks.*', 'medias.id as media_id', 'medias.uuid as media_uuid', 'medias.alt_text as media_alt_text');

        if (!$this->option('force')) {
            $imageBlockQuery->where(function ($q) {
                $q->whereNull('medias.alt_text')
                  ->orWhere('medias.alt_text', '=', '');
            });
        }

        $allBlocks = $allBlocks->merge($imageBlockQuery->get());

        // 2. Ranged Accordion Blocks
        $accordionBlockIds = DB::connection('website')
            ->table('blocks')
            ->where('blocks.type', 'ranged_accordion')
            ->where('blocks.blockable_type', $modelName)
            ->where('blocks.blockable_id', $modelId)
            ->pluck('id');

        if ($accordionBlockIds->isNotEmpty()) {
            $accordionQuery = DB::connection('website')
                ->table('blocks')
                ->join('mediables', function ($join) {
                    $join->on('blocks.id', '=', 'mediables.mediable_id')
                         ->where('mediables.mediable_type', '=', 'blocks');
                })
                ->join('medias', 'mediables.media_id', '=', 'medias.id')
                ->where('blocks.type', 'image')
                ->where('blocks.blockable_type', 'blocks')
                ->whereIn('blocks.blockable_id', $accordionBlockIds)
                ->select('blocks.*', 'medias.id as media_id', 'medias.uuid as media_uuid', 'medias.alt_text as media_alt_text');

            if (!$this->option('force')) {
                $accordionQuery->where(function ($q) {
                    $q->whereNull('medias.alt_text')
                      ->orWhere('medias.alt_text', '=', '');
                });
            }

            $allBlocks = $allBlocks->merge($accordionQuery->get());
        }

        // 3. Gallery New Blocks
        $galleryBlockIds = DB::connection('website')
            ->table('blocks')
            ->where('blocks.type', 'gallery_new')
            ->where('blocks.blockable_type', $modelName)
            ->where('blocks.blockable_id', $modelId)
            ->pluck('id');

        if ($galleryBlockIds->isNotEmpty()) {
            $galleryItemIds = DB::connection('website')
                ->table('blocks')
                ->where('blocks.type', 'gallery_new_item')
                ->whereIn('blocks.parent_id', $galleryBlockIds)
                ->pluck('id');

            if ($galleryItemIds->isNotEmpty()) {
                $galleryQuery = DB::connection('website')
                    ->table('mediables')
                    ->join('medias', 'mediables.media_id', '=', 'medias.id')
                    ->join('blocks', 'mediables.mediable_id', '=', 'blocks.id')
                    ->where('mediables.mediable_type', 'blocks')
                    ->whereIn('mediables.mediable_id', $galleryItemIds)
                    ->select('blocks.*', 'medias.id as media_id', 'medias.uuid as media_uuid', 'medias.alt_text as media_alt_text');

                if (!$this->option('force')) {
                    $galleryQuery->where(function ($q) {
                        $q->whereNull('medias.alt_text')
                          ->orWhere('medias.alt_text', '=', '');
                    });
                }

                $allBlocks = $allBlocks->merge($galleryQuery->get());
            }
        }

        // Remove duplicates by media_id
        $blocks = $allBlocks->unique('media_id');

        if ($blocks->isEmpty()) {
            $this->info('✨ All image blocks already have alt text!', OutputInterface::VERBOSITY_VERBOSE);
            return 0;
        }

        $this->info("Found {$blocks->count()} image block(s) to process\n", OutputInterface::VERBOSITY_VERBOSE);

        $progressBar = $this->output->createProgressBar($blocks->count());
        $progressBar->start();

        $processedCount = 0;

        foreach ($blocks as $block) {
            try {
                // Check if alt text exists and we're not forcing
                if (!empty($block->media_alt_text) && !$this->option('force')) {
                    $progressBar->advance();
                    continue;
                }

                // Construct the image URL from the media UUID
                $url = 'https://artic-web.imgix.net/' . $block->media_uuid;

                $this->line("  Analyzing image: {$url}", OutputInterface::VERBOSITY_VERBOSE);

                // Analyze the image
                $analysis = $this->getLLMImageDescription($url);

                if (empty($analysis['caption'])) {
                    throw new Exception('No caption generated from analysis');
                }

                $this->line("Alt text generated for media #{$block->media_uuid}\n", OutputInterface::VERBOSITY_VERBOSE);
                $this->line("Description:\n\n{$analysis['caption']}\n", OutputInterface::VERBOSITY_VERBOSE);

                // Update the media record with alt text
                DB::connection('website')
                    ->table('medias')
                    ->where('id', $block->media_id)
                    ->update([
                        'alt_text' => $analysis['caption'],
                        'updated_at' => now()
                    ]);

                // Tag it as AI generated
                $tagId = DB::connection('website')
                    ->table('tags')
                    ->where('slug', 'ai-generated-alt-text')
                    ->value('id');

                if ($tagId) {
                    $tagExists = DB::connection('website')
                        ->table('tagged')
                        ->where('taggable_type', 'medias')
                        ->where('taggable_id', $block->media_id)
                        ->where('tag_id', $tagId)
                        ->exists();

                    if (!$tagExists) {
                        DB::connection('website')
                            ->table('tagged')
                            ->insert([
                                'taggable_type' => 'medias',
                                'taggable_id' => $block->media_id,
                                'tag_id' => $tagId,
                            ]);
                    }
                }

                $processedCount++;
            } catch (Exception $e) {
                $this->newLine();
                $this->error("Failed to process block #{$block->id}: " . $e->getMessage(), OutputInterface::VERBOSITY_VERBOSE);

                Log::error('Failed to generate alt text for block', [
                    'block_id' => $block->id ?? null,
                    'media_id' => $block->media_id ?? null,
                    'error' => $e->getMessage()
                ]);
            }

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine();

        return $processedCount;
    }
}
