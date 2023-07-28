<?php

namespace App\Console\Commands\Import;

class ImportWeb extends ImportWebFull
{
    protected $signature = 'import:web
                            {--since= : How far back to scan for records}';

    protected $description = 'Import web CMS data that has been updated since the last import';

    protected $isPartial = true;

    public function handle()
    {
        $this->api = config('resources.sources.web');

        $this->importEndpoints();
    }
}
