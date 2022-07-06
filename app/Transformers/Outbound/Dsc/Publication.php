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
            'site' => [
                'doc' => 'Which site in our multi-site Drupal installation owns this publication',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'alias' => [
                'doc' => 'Used by Drupal in lieu of the id to generate pretty paths',
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
