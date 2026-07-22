<?php

namespace App\Console\Commands\Import;

use App\Models\Archive\Archive;

class ImportArchives extends AbstractImportCommand
{
    protected $signature = 'import:archives
                            {--y|yes : Answer "yes" to all prompts}
                            {--test : Only import one page}';

    protected $description = 'Import archive records from the archives data service';

    public function handle()
    {
        if ($this->option('test')) {
            $this->isTest = true;
        }

        $this->api = config('resources.sources.archives');

        $this->import('archives', Archive::class, 'archives');
    }
}
