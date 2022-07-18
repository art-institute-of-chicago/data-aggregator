<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Exhibition extends BaseTransformer
{
    protected function getFields()
    {
        return [
            // TODO: Refactor relationships:
            'exhibition_id' => [
                'doc' => 'Identifier of the CITI exhibition this website exhibition is tied to',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->exhibition->id ?? null;
                },
            ],

            // Publishing fields:
            'is_featured' => [
                'doc' => 'Is this exhibition currently featured on our website?',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
                'value' => function ($item) {
                    return $item->is_featured ?? false;
                },
            ],
            'list_description' => [
                'doc' => 'Short description to be used for exhibition listings',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
        ];
    }
}
