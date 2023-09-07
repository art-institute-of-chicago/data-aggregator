<?php

namespace App\Transformers\Outbound\Dsc;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Publication extends BaseTransformer
{
    protected function getFields()
    {
        return [
            'web_url' => [
                'doc' => 'URL to the publication',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],

            // TODO: Refactor relationships:
            'section_ids' => [
                'doc' => 'Unique identifiers of the sections of this publication',
                'type' => 'array',
                'elasticsearch' => 'long',
                'value' => function ($item) {
                    return $item->sections->pluck('id');
                },
            ],
        ];
    }
}
