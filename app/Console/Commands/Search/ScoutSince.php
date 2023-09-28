<?php

namespace App\Console\Commands\Search;

use Carbon\Carbon;
use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ScoutSince extends BaseCommand
{
    protected $signature = 'scout:since
                            {since : ISO 8601 datetime string with timezone}';

    protected $description = 'Index all models modified since given datetime';

    private $sinceDateTime;

    private $chunkSize;

    public function handle()
    {
        // Not an ideal solution, but some models are really heavy
        ini_set('memory_limit', '-1');

        // Ex: "2019-02-12T00:00:00-06:00"
        $this->sinceDateTime = new Carbon($this->argument('since'));
        $this->chunkSize = config('scout.chunk.searchable');

        $classes = app('Search')->getSearchableModels();

        foreach ($classes as $class) {
            $this->searchableSince($class);
        }
    }

    public function searchableSince($class)
    {
        $this->info($class);

        $models = $class::whereDate('updated_at', '>=', $this->sinceDateTime);

        $bar = $this->output->createProgressBar($models->count());

        $models->chunk($this->chunkSize, function ($models) use ($bar) {
            $models->searchable();
            $bar->advance($this->chunkSize);
        });

        $bar->finish();
        $this->output->newLine(1);
    }
}
