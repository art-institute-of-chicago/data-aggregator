<?php

namespace App\Console\Commands\Import;

class ImportEnhancerFull extends AbstractImportCommand
{
    protected $signature = 'import:enhancer-full
                            {endpoint? : Endpoint on dataservice to query}
                            {page? : Page to begin importing from}
                            {--test : Only import one page from each endpoint}';

    protected $description = 'Import all data from the enhancer';

    public function handle()
    {
        if ($this->option('test')) {
            $this->isTest = true;
        }

        $this->api = config('resources.sources.dsc');

        $endpoint = $this->argument('endpoint');

        if ($endpoint) {
            $page = $this->argument('page') ?: 1;
            $this->importEndpoint($endpoint, $page);
        } else {
            $this->importEndpoints();
        }
    }

    protected function importEndpoints()
    {
        $this->importEndpoint('agents');
        $this->importEndpoint('artworks');
        $this->importEndpoint('artwork-types');
        $this->importEndpoint('places');
        $this->importEndpoint('terms');
    }

    protected function importEndpoint($endpoint, $page = 1)
    {
        $model = $this->getModelForEndpoint($endpoint);

        $this->import('enhancer', $model, $endpoint, $page);
    }

    protected function getModelForEndpoint($endpoint)
    {
        return app('Resources')->getModelForInboundEndpoint($endpoint, 'enhancer');
    }
}
