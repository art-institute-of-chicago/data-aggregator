<?php

namespace App\Console\Commands\Dump;

class DumpSchedule extends AbstractDumpCommand
{

    protected $signature = 'dump:schedule';

    protected $description = 'Sequence of commands to run for scheduled dumps';

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
