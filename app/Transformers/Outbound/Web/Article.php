<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Article extends BaseTransformer
{
    protected function getFields()
    {
        return [
            'copy' => [
                'doc' => 'The text of the article',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                ],
            ],
        ];
    }
}
