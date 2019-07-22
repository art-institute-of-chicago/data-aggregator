<?php

namespace App\Console\Commands\Update;

use App\Models\Collections\Artwork;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class UpdateResources extends BaseCommand
{

    protected $signature = 'update:resources';

    protected $description = 'Re-indexes artworks that have multimedia or educational resources';

    public function handle()
    {
        Artwork::whereHas('documents', function ($query) {

            $query->where('is_educational_resource', '=', true)
                ->orWhere('is_multimedia_resource', '=', true);

        })
            ->orWhereHas('sites')
            ->orWhereHas('sections')
            ->each(function ($artwork) {

            $artwork->searchable();

            $this->info("Reindexed #{$artwork->id}: {$artwork->title}");

        });

    }

}
