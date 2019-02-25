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
            $this->compareLatest( $model );

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

    public function compareLatest( $model )
    {

        if ($model::count() == 0) {
            return;
        }

        $response = Elasticsearch::search([
            'index' => app('Search')->getIndexForModel( $model ),
            'type' => app('Search')->getTypeForModel( $model ),
            'size' => 1,
            'body' => [
                'sort' => 'timestamp',
            ],
        ]);

        if (count($response['hits']['hits']) == 0) {
            if ($model::count() != 0) {
                $this->info( "Elasticsearch index in empty. {$model::count()} in database");
            }
            return;
        }

        $es_latest = $response['hits']['hits'][0]['_source']['last_updated'];
        $db_latest = $model::first()->updated_at;

        if ($es_latest != $db_latest) {
            $endpoint = app('Resources')->getEndpointForModel( $model );

            $this->info( "{$endpoint} = {$db_latest} in database, {$es_latest} in elasticsearch");
        }
    }
}
