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
                    return $item->exhibition->citi_id ?? null;
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
            'is_published' => [
                'doc' => 'Is this exhibition currently published on our website? Only relevant for non-past exhibitions.',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
                'value' => function ($item) {
                    return $item->is_published ?? false;
                },
                'is_restricted' => true,
            ],

            // TODO: Provide ability to put lengthy fields below relationships?
            'header_copy' => [
                'doc' => 'The text at the top of the exhibition page',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'list_description' => [
                'doc' => 'Short description to be used for exhibition listings',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'exhibition_message' => [
                'doc' => 'Pricing or attendance information',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],

        ];
    }
}
