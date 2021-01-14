<?php

namespace App\Console\Commands\Dump;

class DumpExport extends AbstractDumpCommand
{

    protected $signature = 'dump:export
                            {--path= : Directory where to save dump, with `json` subdir }';

    protected $description = 'Create JSON dumps of all public endpoints';

    public function handle()
    {
        $this->call('dump:reset');

        $this->call('dump:config');

        $this->call('dump:info');

        $this->call('dump:resources');
    }
}
