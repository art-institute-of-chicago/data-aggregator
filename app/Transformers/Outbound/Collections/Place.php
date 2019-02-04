<?php

namespace App\Transformers\Outbound\Collections;

use App\Transformers\Outbound\CollectionsTransformer as BaseTransformer;

class Place extends BaseTransformer
{

    protected function getFields()
    {
        return [
            'type' => [
                'doc' => 'Type always takes one of the following values: AIC Gallery, AIC Storage, No location',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
        ];
    }

}
