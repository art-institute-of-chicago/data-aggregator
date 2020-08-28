<?php

namespace App\Console\Commands\Dump;

use Illuminate\Support\Facades\File;
use Exception;

class DumpNightly extends AbstractDumpCommand
{

    protected $signature = 'dump:nightly';

    protected $description = 'Sequence of commands to run for nightly dumps';

    public function handle()
    {
        $this->info('Dumping getting started...');
        $this->call('dump:getting-started');

        $this->info('Dumping all...');
        $this->call('dump:export');

        $this->info('Uploading to GitHub...');
        $this->call('dump:upload');
    }
}
