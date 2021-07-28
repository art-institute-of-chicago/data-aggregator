<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Command;

class UpdateCloudfrontIps extends Command
{

    protected $signature = 'update:cloudfront-ips';

    protected $description = 'Update file cache of CloudFront IPs for TrustProxies';

    public function handle()
    {
        // This throws an exception if the URL is unreachable
        $contents = file_get_contents('http://d7uri8nf7uskq.cloudfront.net/tools/list-cloudfront-ips');

        if ($contents === false) {
            return;
        }

        // API-189: Remember for two hours, and keep the file as fallback
        // This command should be run on both app and utility after deploy
        Cache::remember('list-cloudfront-ips', 60 * 60 * 2, function () use ($contents) {
            return $contents;
        });

        Storage::put('list-cloudfront-ips.json', $contents);

        $this->info('Cloudfront IPs updated!');
    }
}
