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
            'is_published' => [
                'doc' => 'Whether this static page is available to view (always true)',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
                'value' => function ($item) {
                    return true;
                },
                'is_restricted' => true,
            ],
        ];
    }
}
