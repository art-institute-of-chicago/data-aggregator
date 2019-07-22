<?php

namespace App\Transformers\Outbound\DigitalLabel;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Label extends BaseTransformer
{

    protected function getFields()
    {
        return [
            'exhibition_id' => [
                'doc' => 'Unique identifier of the collections exhibition this label is associated with',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->exhibition->exhibition_citi_id ?? null;
                },
            ],
            'type' => [
                'doc' => 'The type of label this is in the gallery',
                'type' => 'string',
            ],
            'copy_text' => [
                'doc' => 'All the compiled text of this label',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'image_url' => [
                'doc' => 'URL to the main image of this label',
                'type' => 'url',
                'elasticsearch' => 'keyword',
            ],
            'color' => [
                'doc' => 'The main color associated with this label',
                'type' => 'string',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return $item->exhibition->color ?? null;
                },
            ],
            'background_color' => [
                'doc' => 'The background color associated with this label',
                'type' => 'string',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return $item->exhibition->background_color ?? null;
                },
            ],
            'is_published' => [
                'doc' => 'Whether the label is available to view',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
                'value' => function ($item) {
                    return $item->is_published && ($item->exhibition->is_published ?? true);
                },
            ],
        ];
    }

}
