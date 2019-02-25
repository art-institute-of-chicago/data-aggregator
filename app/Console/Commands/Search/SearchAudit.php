<?php

namespace App\Console\Commands\Search;

use Elasticsearch;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class SearchAudit extends BaseCommand
{

    protected $signature = 'search:audit';

    protected $description = 'Compare the counts of database records with those in the search index';


    public function handle()
    {

        $models = app('Search')->getSearchableModels();

        foreach ($models as $model)
        {

            $this->compareTotals( $model );

        }

    }


    public function compareTotals( $model )
    {

        $response = Elasticsearch::search([
            'index' => app('Search')->getIndexForModel( $model ),
            'type' => app('Search')->getTypeForModel( $model ),
            'size' => 0
        ]);

        $es_count = $response['hits']['total'];
        $db_count = $model::count();

        if ($es_count != $db_count) {
            $endpoint = app('Resources')->getEndpointForModel( $model );

            $method = ( abs($es_count - $db_count) > 10 ) ? 'warn' : 'info';
            $this->info( "{$endpoint} = {$db_count} in database, {$es_count} in elasticsearch");
        }
    }
}
