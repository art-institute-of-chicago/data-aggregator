<?php

namespace App\Console\Commands\Report;

use App\Models\Collections\Artwork;
use League\Csv\Writer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PDO;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ReportNewImages extends BaseCommand
{

    protected $signature = 'report:new-images';

    protected $description = 'Get images for last updated artworks';

    public function handle()
    {
        // https://github.com/laravel/framework/issues/14919
        // DB::connection()->getPdo()->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

        $csv = Writer::createFromPath($this->getCsvPath('artwork-updated-images.csv'), 'w');

        $csv->insertOne([
            'artwork_citi_id',
            'artwork_title',
            'image_netx_id',
            'image_netx_uuid',
            'is_public_domain',
        ]);

        $artworks = Artwork::setEagerLoads([])
            ->whereHas('assets', function($query) {
                $query->where('is_doc', false);
                $query->where('preferred', true);
                $query->whereNotNull('netx_uuid');
            })
            ->orderBy('updated_at', 'desc');

        $artworks->chunk(100, function ($artworks, $page) use ($csv) {
            foreach ($artworks as $i => $artwork) {
                if ($artwork->image) {
                    $row = [
                        'artwork_citi_id' => $artwork->citi_id,
                        'artwork_title' => $artwork->title,
                        'image_netx_id' => $artwork->image->lake_guid,
                        'image_netx_uuid' => $artwork->image->netx_uuid,
                        'is_public_domain' => $artwork->is_public_domain,
                    ];

                    $this->info(
                        memory_get_usage() . ' - ' .
                        (($page - 1) * 100 + $i) . ' - ' .
                        json_encode(array_values($row))
                    );

                    $csv->insertOne($row);
                }
            }
        });
    }

    private function getCsvPath($path)
    {
        return Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix() . $path;
    }
}
