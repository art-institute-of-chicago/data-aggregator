<?php

namespace App;

use Exception;

use ScoutEngines\Elasticsearch\ElasticsearchEngine as BaseEngine;

class ElasticsearchEngine extends BaseEngine
{

    private $errorStreak = 0;

    private $maxErrorStreak = 3;

    /**
     * Update the given model in the index.
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $models
     * @return void
     */
    public function update($models)
    {
        $params['body'] = [];

        $models->each(function ($model) use (&$params) {
            $params['body'][] = [
                'update' => $this->getIdIndexType($model),
            ];
            $params['body'][] = [
                'doc' => $model->toSearchableArray(),
                'doc_as_upsert' => true,
            ];
        });

        $result = $this->elastic->bulk($params);

        // TODO: Requeue only the models that failed?
        if (isset($result['errors']) && $result['errors'] === true)
        {
            $failedDocs = array_values(array_filter($result['items'], function ($item) {
                return isset($item['update']['error']);
            }));

            foreach ($failedDocs as $doc)
            {
                $this->errorStreak += 1;

                if ($this->errorStreak > $this->maxErrorStreak)
                {
                    throw new Exception(json_encode($result));
                }

                try {
                    throw new Exception(json_encode($doc));
                } catch (Exception $e) {
                    // https://laravel.com/docs/5.7/errors - The `report` Helper
                    report($e);
                }
            }

        } else {

            $this->errorStreak = 0;

        }
    }

}
