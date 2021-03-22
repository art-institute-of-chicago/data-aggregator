<?php

namespace App\Console\Commands\Dump;

class DumpExport extends AbstractDumpCommand
{

    protected $signature = 'dump:export
                            {--path= : Directory where to save dump, with `json` subdir }';

    protected $description = 'Create JSON dumps of all public endpoints';

    public function handle()
    {
        $endpoints = $this->getResources()->pluck('endpoint');

        $endpoints->each(function ($endpoint) {
            $this->shell->unsafe(function ($shell) use ($endpoint) {
                return $shell->exec(
                    'screen -S %s -X quit',
                    'dump-' . $endpoint
                );
            });
        });

        $this->call('dump:reset');

        $this->call('dump:config');

        $this->call('dump:info');

        $endpoints->each(function ($endpoint) {
            $this->shell->exec(
                'screen -S %s -dm php %s/artisan dump:resources --endpoint=%s',
                'dump-' . $endpoint,
                base_path(),
                $endpoint
            );
        });
    }
}
