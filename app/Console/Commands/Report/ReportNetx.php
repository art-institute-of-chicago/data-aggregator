<?php

namespace App\Console\Commands\Report;

use App\Library\Slug;
use App\Models\Collections\Artwork;
use Illuminate\Database\Eloquent\Builder;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ReportNetx extends BaseCommand
{

    protected $signature = 'report:netx';

    protected $description = 'Show artworks that have NetX images';

    public function handle()
    {
        $artworks = Artwork::query()
            ->whereHas('assets', function (Builder $query) {
                $query->whereNotNull('netx_uuid');
            })
            ->orderBy('pageviews', 'desc')
            ->limit(100);

        foreach ($artworks->cursor() as $artwork) {
            $this->info('https://nocache.staging.artic.edu/artworks/' . $artwork->citi_id . '/' . Slug::getUtf8Slug($artwork->title));
        }
    }
}
