<?php

namespace App\Console\Commands\Import;

class ImportArtistEnrichmentFull extends AbstractImportCommand
{
    protected $signature = 'import:artist-enrichment-full
                            {page? : Page to begin importing from}
                            {--test : Only import one page}';

    protected $description = "Import all artist enrichment data from data-service-artist-enrichment";

    public function handle()
    {
        if ($this->option('test')) {
            $this->isTest = true;
        }

        $this->api = config('resources.sources.artist_enrichment');

        $page = $this->argument('page') ?: 1;
        $model = app('Resources')->getModelForInboundEndpoint('agents', 'artist_enrichment');

        $this->import('artist_enrichment', $model, 'artists', $page);
    }
}
