<?php

namespace App\Transformers\Outbound\Queues;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class WaitTime extends BaseTransformer
{

    protected function getFields()
    {
        return [
            'wait_display' => [
                'doc' => 'User-friendly display of wait time',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
        ];
    }
}
