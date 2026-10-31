<?php

namespace App\Console\Commands\Dump;

use Illuminate\Support\Facades\Process;
use Exception;

class DumpExport extends AbstractDumpCommand
{
    protected $signature = 'dump:export
                            {--path= : Directory where to save dump, with `json` subdir }
                            {--parallel=4 : How many endpoints to dump at the same time}';

    protected $description = 'Create JSON dumps of all public endpoints';

    public function handle()
    {
        $endpoints = $this->getResources()->pluck('endpoint');

        $this->call('dump:reset');

        $this->call('dump:config');

        $this->call('dump:info');

        $this->dumpResourcesInParallel($endpoints->all(), max(1, (int) $this->option('parallel')));

        $this->convertToParquet($endpoints->all());
    }

    /**
     * Run `dump:resources` for each endpoint in its own process, keeping at most `$parallel`
     * running at once. Each child's output is captured and only shown if it fails, since
     * several progress bars writing to the console at once would be unreadable.
     */
    private function dumpResourcesInParallel(array $queue, int $parallel)
    {
        $running = [];
        $failed = [];

        while ($queue || $running) {
            while ($queue && count($running) < $parallel) {
                $endpoint = array_shift($queue);

                $this->info('Dumping ' . $endpoint);

                $running[$endpoint] = Process::path(base_path())->forever()->start([
                    PHP_BINARY,
                    'artisan',
                    'dump:resources',
                    '--endpoint=' . $endpoint,
                    '--skip-parquet',
                ]);
            }

            foreach ($running as $endpoint => $process) {
                if ($process->running()) {
                    continue;
                }

                $result = $process->wait();
                unset($running[$endpoint]);

                if ($result->successful()) {
                    $this->info('Finished ' . $endpoint);
                } else {
                    $failed[] = $endpoint;
                    $this->error('Failed ' . $endpoint . ":\n" . $result->errorOutput() . $result->output());
                }
            }

            usleep(250000);
        }

        if ($failed) {
            throw new Exception('Failed to dump: ' . implode(', ', $failed));
        }
    }
}
