<?php

namespace App;

use Exception;

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

        $result = $this->elastic->bulk($params);

        // TODO: Requeue only the models that failed?
        if (isset($result['errors']) && $result['errors'] === true)
        {
            try {
                // Filter out docs that succeeded
                throw new Exception(json_encode(array_values(array_filter($result['items'], function($item) {
                    return isset($item['update']['error']);
                }))));
            } catch (Exception $e) {
                // https://laravel.com/docs/5.7/errors - The `report` Helper
                report($e);
            }
        }
    }

}
