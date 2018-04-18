<?php

namespace App\Console\Commands;

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

            $this->audit( $model );

        }

    }


    public function audit( $model )
    {

        $response = Elasticsearch::search([
            'index' => app('Search')->getIndexForModel( $model ),
            'type' => app('Search')->getTypeForModel( $model ),
            'size' => 0
        ]);

        $es_count = $response['hits']['total'];
        $db_count = $model::count();

        $method = ( $es_count == $db_count ) ? 'info' : 'warn';

        $endpoint = app('Resources')->getEndpointForModel( $model );

        $this->$method( "{$endpoint} = {$db_count} in db, {$es_count} in es");

    }

}
