<?php

namespace App\Console\Commands\Report;

use App\Library\Slug;
use App\Models\Collections\Artwork;
use App\Models\Collections\Exhibition;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use PDO;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ReportNetx extends BaseCommand
{

    protected $signature = 'report:netx {target}';

    protected $description = 'Show artworks or exhibitions that have NetX images';

    public function handle()
    {
        // https://github.com/laravel/framework/issues/14919
        DB::connection()->getPdo()->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

        switch ($this->argument('target')) {
            case 'artworks':
                $this->artworks();
                break;
            case 'exhibitions':
                $this->exhibitions();
                break;
        }
    }

    private function artworks()
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

    private function exhibitions()
    {
        $exhibitions = Exhibition::query()
            ->whereHas('assets', function (Builder $query) {
                $query->whereNotNull('netx_uuid');
            })
            ->orderBy('date_aic_start', 'desc')
            ->limit(100);

        foreach ($exhibitions->cursor() as $exhibition) {
            $this->info('https://nocache.staging.artic.edu/exhibitions/' . $exhibition->citi_id . '/' . Slug::getUtf8Slug($exhibition->title));
        }
    }
}
