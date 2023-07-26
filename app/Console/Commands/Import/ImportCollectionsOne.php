<?php

namespace App\Console\Commands\Import;

class ImportCollectionsOne extends ImportCollectionsFull
{
    protected $signature = 'import:collections-one
                            {endpoint : Endpoint on dataservice to query, e.g. `object-types` }
                            {id : Identifier of the specific resource to import}';

    protected $description = 'Import a single resource from the collections dataservice.';

    public function handle()
    {
        $endpoint = $this->argument('endpoint');
        $id = $this->argument('id');

        $model = $this->getModelForEndpoint($endpoint);

        $transformer = app('Resources')->getInboundTransformerForModel($model, 'Collections');

        $json = $this->fetchItem($endpoint, $id);

        $datum = $json->data;

        $this->updateSentryTags($datum, $endpoint, 'Collections');

        $this->save($datum, $model, $transformer);
    }

    private function fetchItem($endpoint, $id)
    {
        $url = config('resources.sources.collections') . '/' . $endpoint . '/' . $id;

        $this->info('Fetching: ' . $url);

        return $this->fetch($url, true);
    }
}
