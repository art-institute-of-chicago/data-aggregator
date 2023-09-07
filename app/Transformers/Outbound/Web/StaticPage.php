<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class StaticPage extends BaseTransformer
{
    protected function getFields()
    {
        return [
            'web_url' => [
                'doc' => 'The URL to this page on our website',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
        ];
    }
}
