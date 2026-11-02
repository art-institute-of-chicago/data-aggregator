<?php

namespace App\Console\Commands\Dump;

use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\File as FileFacade;

class DumpReset extends AbstractDumpCommand
{
    protected $signature = 'dump:reset';

    protected $description = 'Clear local/json dumps';

    public function handle()
    {
        $this->info('Clearing local/json dumps');

        $dumpPath = $this->getDumpPath('local/json');

        Process::forever()->run(['rm', '-rf', '--', $dumpPath])->throw();
        FileFacade::ensureDirectoryExists($dumpPath);
    }
}
