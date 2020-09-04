<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Location extends BaseTransformer
{

    protected function getFields()
    {
        return [
            'name' => [
                'doc' => 'Name of the location',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'street' => [
                'doc' => 'Street address of the location',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            // TODO: add documentation for `address` once we learn how it differs from `street`
            'address' => [
                'doc' => '(We\'re unsure how this field differs from `street`)',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'city' => [
                'doc' => 'Name of the city for this location',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'state' => [
                'doc' => 'Name of the state for this location',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'zip' => [
                'doc' => 'Zip code of the location',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'published' => [
                'doc' => 'Whether the location is published on the website',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
                'is_restricted' => true,
            ],
        ];
    }
}
