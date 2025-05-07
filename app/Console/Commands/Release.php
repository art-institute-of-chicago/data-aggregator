<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Storage;

class Release extends BaseCommand
{
    protected $signature = 'release {version : Version number to set}';

    protected $description = 'Bump the version number and run some small tasks';

    public function handle()
    {
        $this->info('Bumping version number...');
        $this->bumpVersionNumber();

        $this->info('Downloading CSS and JS...');
        $this->call('docs:download-css-js');

        $this->info('Creating endpoints docs...');
        $this->call('docs:endpoints');

        $this->info('Creating fields docs...');
        $this->call('docs:fields');

        $this->info('Creating openapi docs...');
        $this->call('docs:openapi');
    }

    private function bumpVersionNumber()
    {
        $version = $this->argument('version');

        Storage::disk('local')->put('VERSION', $version);

        $dest = base_path('VERSION');

        copy(storage_path('app/VERSION'), $dest);
    }
}
