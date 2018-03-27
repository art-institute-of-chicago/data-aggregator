<?php

namespace App\Console\Commands;

use Carbon\Carbon;

class ImportProducts extends AbstractImportCommand
{

    protected $signature = 'import:products';

    protected $description = "Import products data that has been updated since the last import";


    public function handle()
    {

        $this->import('products');

    }

    private function import($endpoint, $current = 1)
    {

        $model = app('Resources')->getModelForEndpoint($endpoint);

        $json = $this->queryService($endpoint, $current);
        $pages = $json->pagination->total_pages;

        $this->info( 'Found ' . $pages . ' page(s) for model ' . $model );

        while ($current <= $pages)
        {

            $this->info( 'Importing ' . $current . ' of ' . $pages . ' for model ' . $model );

            foreach ($json->data as $source)
            {
                $sourceModifiedTime = new Carbon($source->modified_at);
                $sourceModifiedTime->timezone = config('app.timezone');

                if ($this->command->last_success_at->gt($sourceModifiedTime))
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
        $this->info(env('SHOP_DATA_SERVICE_URL') . '/' . $endpoint . '?page=' . $page . '&limit=' . $limit);
        $result = $this->query( env('SHOP_DATA_SERVICE_URL') . '/' . $endpoint . '?page=' . $page . '&limit=' . $limit );

        if( is_null( $result ) ) {
            throw new \Exception("Cannot contact data service: " . $url);
        }

        return $result;
    }

}
