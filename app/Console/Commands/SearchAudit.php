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

        $prefix = env('ELASTICSEARCH_INDEX');

        $models = app('Search')->getSearchableModels();

        foreach ($models as $model)
        {

            $endpoint = app('Resources')->getEndpointForModel($model);
            $index = $prefix . '-' . $endpoint;

            $this->audit( $model, $index, $endpoint );

        }

    }


    public function audit( $model, $index, $endpoint )
    {

        $response = Elasticsearch::search([
            'index' => $index,
            'type' => 'doc',
            'size' => 0
        ]);

        $es_count = $response['hits']['total'];
        $db_count = $model::count();

        $method = ( $es_count == $db_count ) ? 'info' : 'warn';

        $this->$method( "{$endpoint} = {$db_count} in db, {$es_count} in es");

    }

}
