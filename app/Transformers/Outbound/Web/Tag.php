<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Tag extends BaseTransformer
{

    protected function getFields()
    {
        return [
            'name' => [
                'doc' => 'Name of the tag',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
        ];
    }

}
