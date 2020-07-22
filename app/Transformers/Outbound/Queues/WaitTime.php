<?php

namespace App\Transformers\Outbound\Queues;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class WaitTime extends BaseTransformer
{

    protected function getFields()
    {
        return [
            'duration' => [
                'doc' => 'Length of time of wait',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'units' => [
                'doc' => 'Unit of time that `length` represents',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'display' => [
                'doc' => 'User-friendly display of wait time',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
        ];
    }

}
