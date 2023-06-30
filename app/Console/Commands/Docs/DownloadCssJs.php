<?php

namespace App\Console\Commands\Docs;

use Illuminate\Support\Facades\Storage;

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
                'fonts/sabon/3545D5_0_0.woff2' => '../fonts/sabon/3545D5_0_0.woff2',
                'fonts/sabon/3545D5_1_0.woff2' => '../fonts/sabon/3545D5_1_0.woff2',
                'fonts/sabon/3545D5_2_0.woff2' => '../fonts/sabon/3545D5_2_0.woff2',
                'images/favicon-16.png' => 'images/favicon-16.png',
                'images/favicon-152.png' => 'images/favicon-152.png',
                'images/favicon-120.png' => 'images/favicon-120.png',
                'images/favicon-76.png' => 'images/favicon-76.png',
            ]
        );

        foreach ($files as $vanityName => $fileName) {
            $file = 'https://www.artic.edu/dist/' . $fileName;
            $file = str_replace('dist/../', '', $file);
            $contents = file_get_contents($file);
            Storage::disk('local')->put($vanityName, $contents);

            $dest = base_path('docs/.vuepress/public/assets/' . $vanityName);

            $path = pathinfo($dest);

            if (!file_exists($path['dirname'])) {
                mkdir($path['dirname'], 0777, true);
            }

            copy(
                storage_path('app/' . $vanityName),
                $dest
            );
        }

        // @TODO: once the website is public, pull the logo SVG from the GitHub repo
    }
}
