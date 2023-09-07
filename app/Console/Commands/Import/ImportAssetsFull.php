<?php

namespace App\Console\Commands\Import;

class ImportAssetsFull extends AbstractImportCommand
{
    protected $signature = 'import:assets-full
                            {endpoint? : Endpoint on dataservice to query, e.g. `images`}
                            {page? : Page to begin importing from}
                            {--test : Only import one page from each endpoint}';

    protected $description = 'Import all DAMS data';

    public function handle()
    {
        if ($this->option('test')) {
            $this->isTest = true;
        }

        $this->api = config('resources.sources.assets');

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
        $this->importEndpoint('videos');
        $this->importEndpoint('texts');
        $this->importEndpoint('sounds');
        $this->importEndpoint('images');
    }

    protected function importEndpoint($endpoint, $page = 1)
    {
        $model = $this->getModelForEndpoint($endpoint);

        $this->import('assets', $model, $endpoint, $page);
    }

    protected function getModelForEndpoint($endpoint)
    {
        return app('Resources')->getModelForInboundEndpoint($endpoint, 'assets');
    }

    /**
     * Temporarily overriding this to have control over the `$limit` default here.
     */
    protected function query($endpoint, $page = 1, $limit = 500)
    {
        $limit = 1000;

        return parent::query($endpoint, $page, $limit);
    }
}
