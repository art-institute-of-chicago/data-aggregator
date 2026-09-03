<?php

namespace App\Console\Commands\Import;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;
use App\Models\Collections\Asset;
use App\Models\Collections\Image;
use App\Services\CloudflareKvService;
use App\Services\IiifGeometryService;
use Illuminate\Support\Facades\Http;

class ImportAssetsIiifGeometry extends BaseCommand
{
    protected $signature = 'import:assets-iiif-geometry
                            {--full : Re-sync every image, not just new/stale ones}
                            {--chunk=200 : Rows per batch (also the Http::pool concurrency)}
                            {--dry-run : Skip the Cloudflare KV push}';

    protected $description = 'Fetches IIIF info.json geometry for images, pushes it to the Cloudflare KV store';

    protected CloudflareKvService $kv;

    public function __construct(CloudflareKvService $kv)
    {
        parent::__construct();

        $this->kv = $kv;
    }

    public function handle()
    {
        $query = Image::query();

        if (!$this->option('full')) {
            $query->where(function ($q) {
                $q->whereNull('iiif_synced_at')
                    ->orWhereColumn('updated_at', '>', 'iiif_synced_at');
            });
        }

        $total = $query->count();
        $this->info("Syncing IIIF geometry for {$total} image(s)...");

        $processed = 0;
        $kvBuffer = [];

        $query->chunkById((int) $this->option('chunk'), function ($images) use (&$processed, &$kvBuffer, $total) {
            // Fetch every image's info.json in this chunk concurrently.
            $responses = Http::pool(fn ($pool) => $images->map(
                fn ($image) => $pool->as((string) $image->id)
                    ->timeout(IiifGeometryService::TIMEOUT_SECONDS)
                    ->retry(IiifGeometryService::MAX_RETRIES, 500, throw: false)
                    ->get($image->iiif_url . '/info.json')
            ));

            foreach ($images as $image) {
                $response = $responses[(string) $image->id];

                if (!$response->successful()) {
                    $this->warn("  info.json failed for #{$image->id}: " . $response->status());
                    continue;
                }

                $info = $response->json();
                $tile = $info['tiles'][0] ?? null;

                $image->width = $info['width'] ?? null;
                $image->height = $info['height'] ?? null;
                $image->tile_width = $tile['width'] ?? null;
                $image->tile_height = $tile['height'] ?? null;
                $image->scale_factors = $tile['scaleFactors'] ?? null;
                $image->iiif_synced_at = now();
                $image->save();

                $kvBuffer[] = [
                    'key' => Asset::getHashedId($image->id),
                    'value' => json_encode([
                        'w' => $image->width,
                        'h' => $image->height,
                        'tw' => $image->tile_width,
                        'th' => $image->tile_height,
                        'sf' => $image->scale_factors,
                        'tiled' => (bool) $tile,
                        'crawledAt' => $image->iiif_synced_at->toIso8601String(),
                    ]),
                ];
            }

            $processed += $images->count();
            $this->info("  {$processed}/{$total} processed");

            if (count($kvBuffer) >= 5000) {
                $this->flushToKv($kvBuffer);
                $kvBuffer = [];
            }
        });

        if ($kvBuffer) {
            $this->flushToKv($kvBuffer);
        }
    }

    private function flushToKv(array $entries)
    {
        if ($this->option('dry-run')) {
            $this->info('  [dry-run] would push ' . count($entries) . ' KV entries');
            return;
        }

        $this->kv->bulkPut($entries);
        $this->info('  pushed ' . count($entries) . ' KV entries');
    }
}
