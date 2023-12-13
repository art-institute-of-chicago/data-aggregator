<?php

namespace App\Console\Commands\Search;

use League\Csv\Reader;
use Illuminate\Support\Facades\Storage;
use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ScoutImportCsv extends BaseCommand
{
    protected $signature = 'scout:import-csv
                            {model : Fully namespaced model name}
                            {filename : CSV file in `storage/app` directory}
                            {--skip-header : Skips first line when importing}';

    protected $description = 'Import all IDs in CSV of a model into the search index';

    public function handle()
    {
        $class = $this->argument('model');

        $csv = Reader::createFromPath($this->getCsvPath(), 'r');

        if (!$this->hasOption('skip-header') || $this->option('skip-header')) {
            $csv->setHeaderOffset(0);
        }

        foreach ($csv->getRecords() as $record) {
            $id = reset($record);

            if (is_string($id) && strpos($id, ' ') !== false) {
                $id = explode(' ', $id);
                $id = end($id);
            }

            $class::find($id)->searchable();

            $this->info("Imported #${id} of model ${class}");
        }
    }

    protected function getCsvPath()
    {
        return Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix() . $this->argument('filename');
    }
}
