<?php

namespace App\Console\Commands\Import;

class ImportAssetsOne extends ImportAssetsFull
{
    protected $signature = 'import:assets-one
                            {endpoint : Endpoint on dataservice to query, e.g. `object-types` }
                            {id : Identifier of the specific resource to import}';

    protected $description = 'Import a single resource from the assets dataservice.';

    public function handle()
    {
        $endpoint = $this->argument('endpoint');
        $id = $this->argument('id');

        $model = $this->getModelForEndpoint($endpoint);

        $transformer = app('Resources')->getInboundTransformerForModel($model, 'assets');

        $json = $this->fetchItem($endpoint, $id);

        $datum = $json->data;

        $this->updateSentryTags($datum, $endpoint, 'assets');

        $this->save($datum, $model, $transformer);
    }

    private function fetchItem($endpoint, $id)
    {
        $url = env('ASSETS_DATA_SERVICE_URL') . '/' . $endpoint . '/' . $id;

        $this->info('Fetching: ' . $url);

        return $this->fetch($url, true);
    }
}
