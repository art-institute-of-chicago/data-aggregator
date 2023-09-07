<?php

namespace App\Console\Commands\Import;

class ImportWebOne extends ImportWebFull
{
    protected $signature = 'import:web-one
                            {endpoint : Endpoint on dataservice to query, e.g. `events` }
                            {id : Identifier of the specific resource to import}';

    protected $description = 'Import a single resource from the web dataservice.';

    public function handle()
    {
        if (config('aic.web.username')) {
            $this->auth = config('aic.web.username') . ':' . config('aic.web.password');
        }

        $endpoint = $this->argument('endpoint');
        $id = $this->argument('id');

        $model = $this->getModelForEndpoint($endpoint);

        $transformer = app('Resources')->getInboundTransformerForModel($model, 'Web');

        $json = $this->fetchItem($endpoint, $id);

        $datum = $json->data;

        $this->updateSentryTags($datum, $endpoint, 'Web');

        $this->save($datum, $model, $transformer);
    }

    private function fetchItem($endpoint, $id)
    {
        $url = config('resources.sources.web') . '/' . $endpoint . '/' . $id;

        $this->info('Fetching: ' . $url);

        return $this->fetch($url, true);
    }
}
