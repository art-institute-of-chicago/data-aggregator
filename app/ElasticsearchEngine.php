<?php

namespace App;

use ScoutEngines\Elasticsearch\ElasticsearchEngine as BaseEngine;

class ElasticsearchEngine extends BaseEngine
{

    /**
     * Update the given model in the index.
     *
     * @param  Collection  $models
     * @return void
     */
    public function update($models)
    {
        $params['body'] = [];

        $models->each(function($model) use (&$params)
        {
            $params['body'][] = [
                'update' => $this->getIdIndexType($model)
            ];
            $params['body'][] = [
                'doc' => $model->toSearchableArray(),
                'doc_as_upsert' => true
            ];
        });

        // dd( $params );

        $result = $this->elastic->bulk($params);

        // Unfortunately, we aren't quite ready to handle these exceptions.

        // if (isset($result['errors']) === true && $result['errors'] === true)
        // {
        //     throw new \Exception(json_encode($result));
        // }
    }

}
