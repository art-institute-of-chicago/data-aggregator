<?php

namespace App\Console\Commands\Report;

use App\Library\Slug;
use App\Models\Collections\Artwork;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use PDO;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ReportNetx extends BaseCommand
{

    protected $signature = 'report:netx';

    protected $description = 'Show artworks that have NetX images';

    public function handle()
    {
        // https://github.com/laravel/framework/issues/14919
        DB::connection()->getPdo()->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

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
