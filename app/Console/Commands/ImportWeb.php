<?php

namespace App\Console\Commands;

use Carbon\Carbon;

class ImportWeb extends AbstractImportCommand
{

    protected $signature = 'import:web';

    protected $description = "Import web CMS data that has been updated since the last import";


    public function handle()
    {

        $this->import('articles');
        $this->import('artists');
        $this->import('closures');
        $this->import('events');
        $this->import('exhibitions');
        $this->import('hours');
        //$this->import('locations');
        //$this->import('pages');
        $this->import('selections');
        $this->import('tags');

    }

    private function import($endpoint, $current = 1)
    {

        $localEndpoint = $endpoint;
        if ($localEndpoint == 'exhibitions' || $localEndpoint == 'artists')
        {

            $localEndpoint = 'web-' .$localEndpoint;

        }
        $model = app('Resources')->getModelForEndpoint($localEndpoint);

        $json = $this->queryService($endpoint, $current);
        $pages = $json->pagination->total_pages;

        $this->info( 'Found ' . $pages . ' page(s) for model ' . $model );

        while ($current <= $pages)
        {

            $this->info( 'Importing ' . $current . ' of ' . $pages . ' for model ' . $model );

            foreach ($json->data as $source)
            {
                $lastUpdated = new Carbon($source->last_updated);
                $lastUpdated->timezone = config('app.timezone');

                if ($this->command->last_success_at->gt($lastUpdated))
                {
                    break 2;
                }

                $this->saveDatum( $source, $model );

            }

            $current++;
            $json = $this->queryService($endpoint, $current);

        }

    }

    private function queryService($endpoint, $page = 1, $limit = 100)
    {

        $url = env('WEB_CMS_DATA_SERVICE_URL') . '/' . $endpoint . '?page=' . $page . '&limit=' . $limit;

        $this->info( 'Querying: ' . $url );

        $auth = '';
        if (env('WEB_CMS_DATA_SERVICE_USERNAME'))
        {

            $auth = env('WEB_CMS_DATA_SERVICE_USERNAME') .':' .env('WEB_CMS_DATA_SERVICE_PASSWORD');

        }

        $result = $this->query( $url, $auth );

        if( is_null( $result ) ) {
            throw new \Exception("Cannot contact data service: " . $url);
        }

        return $result;

    }

}
