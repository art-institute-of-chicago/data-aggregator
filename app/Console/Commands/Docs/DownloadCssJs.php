<?php

namespace App\Console\Commands\Docs;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DownloadCssJs extends AbstractDocCommand
{

    protected $signature = 'docs:download-css-js';

    protected $description = 'Download CSS and JS from the main website';

    protected $manifest = 'https://www.artic.edu/dist/rev-manifest.json';

    public function handle()
    {
        $files = json_decode(file_get_contents($this->manifest));

        foreach ($files as $vanityName => $fileName) {
            $contents = file_get_contents('https://www.artic.edu/dist/' .$fileName);
            Storage::disk('local')->put($vanityName, $contents);
        }
    }

}
