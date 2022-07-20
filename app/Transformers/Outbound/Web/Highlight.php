<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Highlight extends BaseTransformer
{
    protected function getFields()
    {
        return [
            'copy' => [
                'doc' => 'The text of the highlight description',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                ],
            ],
        ];
    }
}
