<?php

namespace App\Console\Commands\AI;

use App\Behaviors\HandleEmbeddings;
use App\Behaviors\Thresholds;
use App\Console\Commands\BaseCommand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\OutputInterface;
use Exception;

class GenerateAltText extends BaseCommand implements Thresholds
{
    use HandleEmbeddings;

    /**
     * Usage: php artisan ai:generate-alt-text [model_name] [model_ids...] [options]
     *
     * Examples:
     *  php artisan ai:generate-alt-text articles 1247 1253
     *  php artisan ai:generate-alt-text articles {1200..1203}
     *
     * Options:
     *  --force      Overwrite ALL existing alt text
     *  --force-ai   Overwrite ONLY AI-generated alt text
     *  --skip-ai    Skip media already tagged as AI-generated
     *  --mediables  Only process direct attachments
     *  --blocks     Only process images in PageBuilder blocks
     *  --export     Export results to CSV in storage/app/
     *  --preview    Run analysis without saving to DB
     *  --prompt=    Prompt type to use ('standard', 'editorial')
     */

    protected $signature = 'ai:generate-alt-text
                            {model_name? : The morph name of the model (e.g., articles)}
                            {model_ids?* : One or more IDs of the model instances}
                            {--mediables : Process only mediables}
                            {--blocks : Process only image blocks}
                            {--force : Regenerate ALL alt text even if it exists}
                            {--force-ai : Regenerate only AI-generated alt text}
                            {--skip-ai : Skip media with AI-generated alt text}
                            {--export : Export the results to a CSV file in storage/app}
                            {--preview : Run the analysis without saving to the database}
                            {--prompt=standard : The type of prompt to use (e.g., standard, editorial)}';

    protected $description = 'Generate a visual description for use in alt text';

    private ?int $aiGeneratedTagId = null;
    private ?int $manualNeededTagId = null;
    private $csvExport = null;

    public function handle(): int
    {
        try {
            $this->info($this->getAicLogo(), OutputInterface::VERBOSITY_VERBOSE);

            if ($this->option('preview')) {
                $this->warn('🧪 PREVIEW MODE: Analysis will run, but no database changes will be made.');
            }

            if ($this->option('force-ai') && $this->option('skip-ai')) {
                $this->error('❌ Cannot use --force-ai and --skip-ai together');
                return self::FAILURE;
            }

            $this->cacheTagIds();
            $this->initExport();

            $processedCount = 0;
            $modelName = $this->argument('model_name');
            $modelIds = $this->argument('model_ids') ?? [];
            $hasSpecificIds = !empty($modelIds);

            // Determine processing mode
            if ($this->option('mediables') && !$this->option('blocks')) {
                $processedCount = $hasSpecificIds
                    ? $this->processMultipleModels($modelName, $modelIds)
                    : $this->processAllMediables();
            } elseif ($this->option('blocks') && !$this->option('mediables')) {
                $processedCount = $this->processImageBlocksForMultipleModels($modelName, $modelIds);
            } else {
                if ($modelName && $hasSpecificIds) {
                    $processedCount += $this->processMultipleModels($modelName, $modelIds);
                    $processedCount += $this->processImageBlocksForMultipleModels($modelName, $modelIds);
                } else {
                    $processedCount += $this->processAllMediables();
                    $processedCount += $this->processImageBlocks(null, null);
                }
            }

            $this->closeExport();

            $status = $this->option('preview') ? 'Analyzed (Preview)' : 'Processed';
            $this->info("\n✅ Command complete. Total {$status}: {$processedCount}");

            return self::SUCCESS;
        } catch (Exception $e) {
            $this->closeExport();
            $this->error("\n💥 Error: " . $e->getMessage(), OutputInterface::VERBOSITY_VERBOSE);
            Log::error('GenerateAltText command failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return self::FAILURE;
        }
    }

    protected function initExport(): void
    {
        if ($this->option('export')) {
            $filename = 'alt-text-' . ($this->option('preview') ? 'preview-' : 'export-') . now()->format('Y-m-d-His') . '.csv';
            $path = storage_path('app/' . $filename);
            $this->csvExport = fopen($path, 'w');

            fputs($this->csvExport, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($this->csvExport, ['Media ID', 'UUID', 'Source Model', 'Source ID', 'New Alt Text', 'Analysis URL', 'Status']);

            $this->info("📄 CSV Export at: storage/app/{$filename}");
        }
    }

    protected function closeExport(): void
    {
        if ($this->csvExport) {
            fclose($this->csvExport);
        }
    }

    protected function analyzeAndStoreImage($media, $sourceModel, $sourceId): void
    {
        $url = "https://artic-web.imgix.net/{$media->uuid}?w=843";

        $this->info("\n  → Analyzing: {$url}", OutputInterface::VERBOSITY_VERBOSE);

        $promptType = $this->option('prompt') ?? 'standard';
        $analysis = $this->getLLMImageDescription($url, $promptType);

        if (empty($analysis['caption'])) {
            throw new Exception('LLM returned empty caption');
        }

        // Only save if NOT in preview mode
        if (!$this->option('preview')) {
            DB::connection('website')
                ->table('medias')
                ->where('id', $media->id)
                ->update([
                    'alt_text' => $analysis['caption'],
                    'updated_at' => now()
                ]);

            $this->tagMediaAsAiGenerated($media->id);
            $this->removeManualNeededTag($media->id);
        }

        if ($this->csvExport) {
            fputcsv($this->csvExport, [
                $media->id,
                $media->uuid,
                $sourceModel,
                $sourceId,
                $analysis['caption'],
                $url,
                $this->option('preview') ? 'Preview Only' : 'Saved'
            ]);
        }

        $label = $this->option('preview') ? "Preview Text" : "Alt Text";
        $this->info("  {$label}: " . Str::limit($analysis['caption'], 75), OutputInterface::VERBOSITY_VERBOSE);
    }

    protected function tagMediaAsAiGenerated(int $mediaId): void
    {
        if (!$this->aiGeneratedTagId || $this->option('preview')) return;
        DB::connection('website')->table('tagged')->updateOrInsert(
            ['taggable_type' => 'media', 'taggable_id' => $mediaId, 'tag_id' => $this->aiGeneratedTagId],
            []
        );
    }

    protected function tagMediaAsManualNeeded(int $mediaId): void
    {
        if (!$this->manualNeededTagId || $this->option('preview')) return;
        DB::connection('website')->table('tagged')->updateOrInsert(
            ['taggable_type' => 'media', 'taggable_id' => $mediaId, 'tag_id' => $this->manualNeededTagId],
            []
        );
    }

    protected function removeManualNeededTag(int $mediaId): void
    {
        if (!$this->manualNeededTagId || $this->option('preview')) return;
        DB::connection('website')->table('tagged')
            ->where('taggable_type', 'media')
            ->where('taggable_id', $mediaId)
            ->where('tag_id', $this->manualNeededTagId)
            ->delete();
    }

    protected function cacheTagIds(): void
    {
        $this->aiGeneratedTagId = DB::connection('website')->table('tags')->where('slug', 'ai-generated-alt-text')->value('id');
        $this->manualNeededTagId = DB::connection('website')->table('tags')->where('slug', 'manual-alt-text-needed')->value('id');
    }

    protected function shouldSkipMedia($media): bool
    {
        $hasAiTag = $this->mediaHasAiTag($media->id);
        if ($this->option('force')) return $this->option('skip-ai') && $hasAiTag;
        if ($this->option('force-ai')) return !$hasAiTag;
        if ($this->option('skip-ai')) return $hasAiTag;
        return !empty($media->alt_text);
    }

    protected function mediaHasAiTag(int $mediaId): bool
    {
        if (!$this->aiGeneratedTagId) return false;
        return DB::connection('website')->table('tagged')
            ->where('taggable_type', 'media')
            ->where('taggable_id', $mediaId)
            ->where('tag_id', $this->aiGeneratedTagId)
            ->exists();
    }

    protected function processMultipleModels(string $modelName, array $modelIds): int
    {
        $this->info("🔍 Processing {$modelName} for " . count($modelIds) . " ID(s)...", OutputInterface::VERBOSITY_VERBOSE);

        $processedCount = 0;
        foreach ($modelIds as $modelId) {
            $mediables = DB::connection('website')
                ->table('mediables')
                ->where('mediable_type', $modelName)
                ->where('mediable_id', $modelId)
                ->get();

            $processedCount += $this->processMediables($mediables, $modelName, $modelId);
        }
        return $processedCount;
    }

    protected function processMediables($mediables, ?string $mName = null, ?string $mId = null): int
    {
        if ($mediables->isEmpty()) return 0;

        $this->info("Found {$mediables->count()} mediable(s) to check.", OutputInterface::VERBOSITY_VERBOSE);
        $progressBar = $this->output->createProgressBar($mediables->count());
        $processedCount = 0;

        foreach ($mediables as $mediable) {
            try {
                $media = DB::connection('website')->table('medias')->where('id', $mediable->media_id)->first();

                if (!$media || $this->shouldSkipMedia($media)) {
                    $progressBar->advance();
                    continue;
                }

                $this->analyzeAndStoreImage($media, $mName ?? $mediable->mediable_type, $mId ?? $mediable->mediable_id);
                $processedCount++;
            } catch (Exception $e) {
                if (!$this->option('preview')) {
                    $this->tagMediaAsManualNeeded($mediable->media_id);
                }
                $this->warn("\n⚠️ Error media #{$mediable->media_id}: {$e->getMessage()}", OutputInterface::VERBOSITY_VERBOSE);
            }
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine();
        return $processedCount;
    }

    protected function processAllMediables(): int
    {
        $this->info("🔍 Searching for all mediables...", OutputInterface::VERBOSITY_VERBOSE);
        $query = DB::connection('website')->table('mediables')
            ->leftJoin('medias', 'mediables.media_id', '=', 'medias.id')
            ->select('mediables.*');

        $query = $this->applyFilters($query);
        return $this->processMediables($query->get());
    }

    protected function processImageBlocksForMultipleModels(?string $modelName, array $modelIds): int
    {
        if (!$modelName || empty($modelIds)) return $this->processImageBlocks(null, null);
        $count = 0;
        foreach ($modelIds as $modelId) {
            $count += $this->processImageBlocks($modelName, $modelId);
        }
        return $count;
    }

    protected function processImageBlocks($modelName, $modelId): int
    {
        $this->info("🔍 Searching for image blocks...", OutputInterface::VERBOSITY_VERBOSE);

        $query = DB::connection('website')->table('mediables')
            ->join('medias', 'mediables.media_id', '=', 'medias.id')
            ->join('blocks', 'mediables.mediable_id', '=', 'blocks.id')
            ->where('mediables.mediable_type', 'blocks')
            ->select('mediables.*');

        if ($modelName && $modelId) {
            $query->where('blocks.blockable_type', $modelName)
                  ->where('blocks.blockable_id', $modelId);
        }

        $query = $this->applyFilters($query);
        return $this->processMediables($query->get(), 'blocks');
    }

    protected function applyFilters($query)
    {
        if ($this->option('force-ai')) {
            $query->join('tagged', fn($j) => $j->on('medias.id', 'tagged.taggable_id')
                ->where('tagged.taggable_type', 'media')
                ->where('tagged.tag_id', $this->aiGeneratedTagId));
        } elseif ($this->option('skip-ai')) {
            $query->leftJoin('tagged', fn($j) => $j->on('medias.id', 'tagged.taggable_id')
                ->where('tagged.taggable_type', 'media')
                ->where('tagged.tag_id', $this->aiGeneratedTagId))
                ->whereNull('tagged.id');
        }

        if (!$this->option('force') && !$this->option('force-ai')) {
            $query->where(fn($q) => $q->whereNull('medias.alt_text')->orWhere('medias.alt_text', ''));
        }
        return $query;
    }
}
