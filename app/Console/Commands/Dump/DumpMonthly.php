<?php

namespace App\Console\Commands\Dump;

use Illuminate\Support\Facades\File;
use Exception;

class DumpMonthly extends AbstractDumpCommand
{

    protected $signature = 'dump:monthly';

    protected $description = 'Sequence of commands to run for monthly dumps';

    public function handle()
    {
        // WEB-2013: Hotifx to prevent this from running, for the moment!
        return;

        $this->info('Dumping getting started...');
        $this->call('dump:getting-started');

        // WEB-2013: `dump:export`
        $this->info('Dumping all...');
        $this->call('dump:export');

        /**
         * WEB-2013: `dump:export` exits immediately after launching screens.
         * If we allow this to run, it will upload an incomplete dump to GitHub!
         *
         * Currently, we should call `dump:export` manually, and manually check
         * that all of the screens have exited before uploading a dump. This
         * verification process should be automated before we enable this.
         */
        // $this->info('Uploading to GitHub...');
        // $this->call('dump:upload');
    }
}
