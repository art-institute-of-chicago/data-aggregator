<?php

namespace App\Console\Commands\Import;

class ImportWebOne extends ImportWebFull
{

    protected $signature = 'import:web-one
                            {endpoint : Endpoint on dataservice to query, e.g. `events` }
                            {id : Identifier of the specific resource to import}';

    protected $description = "Import a single resource from the web dataservice.";

    public function handle()
    {

        if (env('WEB_CMS_DATA_SERVICE_USERNAME'))
        {
            $this->auth = env('WEB_CMS_DATA_SERVICE_USERNAME') . ':' . env('WEB_CMS_DATA_SERVICE_PASSWORD');
        }

        $endpoint = $this->argument('endpoint');
        $id = $this->argument('id');

        $model = $this->getModelForEndpoint($endpoint);

        $transformer = app('Resources')->getInboundTransformerForModel( $model, 'Web' );

        $json = $this->fetchItem( $endpoint, $id );

        $datum = $json->data;

        $this->updateSentryTags( $datum, $endpoint, 'Web' );

        $this->save( $datum, $model, $transformer );

    }

    private function fetchItem($endpoint, $id)
    {

        $url = env('WEB_CMS_DATA_SERVICE_URL') . '/' . $endpoint . '/' . $id;

        $this->info( 'Fetching: ' . $url );

        return $this->fetchWithAuth( $url, true );
    }

}
