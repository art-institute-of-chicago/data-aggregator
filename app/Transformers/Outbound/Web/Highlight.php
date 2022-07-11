<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Highlight extends BaseTransformer
{
    protected function getFields()
    {
        return [
            'short_copy' => [
                'doc' => 'A brief summary of what is contained in the highlight',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
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
