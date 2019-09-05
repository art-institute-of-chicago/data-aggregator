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
        $files = array_merge(
            json_decode(file_get_contents($this->manifest), true),
            [
                'fonts/3545D5_0_0.eot' => 'fonts/3545D5_0_0.eot',
                'fonts/3545D5_0_0.woff' => 'fonts/3545D5_0_0.woff',
                'fonts/3545D5_0_0.woff2' => 'fonts/3545D5_0_0.woff2',
                'fonts/3545D5_0_0.ttf' => 'fonts/3545D5_0_0.ttf',
                'fonts/3545D5_1_0.eot' => 'fonts/3545D5_1_0.eot',
                'fonts/3545D5_1_0.woff' => 'fonts/3545D5_1_0.woff',
                'fonts/3545D5_1_0.woff2' => 'fonts/3545D5_1_0.woff2',
                'fonts/3545D5_1_0.ttf' => 'fonts/3545D5_1_0.ttf',
                'fonts/3545D5_2_0.eot' => 'fonts/3545D5_2_0.eot',
                'fonts/3545D5_2_0.woff' => 'fonts/3545D5_2_0.woff',
                'fonts/3545D5_2_0.woff2' => 'fonts/3545D5_2_0.woff2',
                'fonts/3545D5_2_0.ttf' => 'fonts/3545D5_2_0.ttf',
            ]
        );

        foreach ($files as $vanityName => $fileName) {
            $contents = file_get_contents('https://www.artic.edu/dist/' .$fileName);
            Storage::disk('local')->put($vanityName, $contents);
        }
    }
}
