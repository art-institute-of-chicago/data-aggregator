<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Artwork extends BaseTransformer
{
    protected function getTitles()
    {
        return array_replace_recursive(parent::getTitles(), [
            'title' => [
                'value' => function ($item) {
                    return $item->artwork->title ?? null;
                },
            ],
        ]);
    }

    protected function getFields()
    {
        return [
            'artwork_id' => [
                'doc' => 'Unique identifier of the CITI artwork record this artwork represents',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    // API-91: Specify `with` on this field; be careful about infinite loops
                    return $item->artwork->id ?? null;
                },
            ],
            'has_advanced_imaging' => [
                'doc' => 'Whether this artwork is enhanced with 3D models, 360 image sequences, Mirador views, etc.',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
        ];
    }
}
