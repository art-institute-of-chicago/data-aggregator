<?php

namespace App\Console\Commands\Import;

class ImportArtistEnrichment extends ImportArtistEnrichmentFull
{
    protected $signature = 'import:artist-enrichment
                            {page? : Page to begin importing from}
                            {--since= : How far back to scan for records}
                            {--test : Only import one page}';

    protected $description = 'Import artist enrichment data updated since last import';

    protected $isPartial = true;

    public function handle()
    {
        $this->api = config('resources.sources.artist_enrichment');
        $this->importEndpoints();
    }

    protected function importEndpoints()
    {
        $model = app('Resources')->getModelForInboundEndpoint('agents', 'artist_enrichment');

        $this->import('artist_enrichment', $model, 'artists');
    }
}
