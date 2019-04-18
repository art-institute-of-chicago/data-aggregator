<?php

namespace App\Transformers\Outbound\Collections;

use App\Transformers\Outbound\Collections\Traits\HidesDefaultFields;

use App\Transformers\Outbound\CollectionsTransformer as BaseTransformer;

class ArtworkCatalogue extends BaseTransformer
{

    use HidesDefaultFields;

    protected function getFields()
    {
        return [
            'is_preferred' => [
                'doc' => 'Whether this catalogue raisonne is the preferred catalogue for this work',
                'type' => 'boolean',
                'value' => function ($item) {
                    return $item->preferred;
                },
            ],
            'number' => [
                'doc' => 'The page or section of the catalogue raisonne that represents this work',
                'type' => 'string',
            ],
            'state_edition' => [
                'doc' => 'The edition of the catalogue that includes this work',
                'type' => 'string',
            ],

            // TODO: Refactor relationships:
            'artwork_title' => [
                'doc' => 'Name of the artwork this catalogue raisonne includes',
                'type' => 'string',
                'value' => function ($item) {
                    return $item->artwork->title ?? null;
                },
            ],
            'artwork_id' => [
                'doc' => 'Unique identifier of the artwork this catalogue raisonne includes',
                'type' => 'number',
                'value' => function ($item) {
                    return $item->artwork->citi_id ?? null;
                },
            ],
            'catalogue_title' => [
                'doc' => 'Name of the catalogue raisonne',
                'type' => 'string',
                'value' => function ($item) {
                    return $item->catalogue->title ?? null;
                },
            ],
            'catalogue_id' => [
                'doc' => 'Unique identifier of the catalogue raisonne',
                'type' => 'number',
                'value' => function ($item) {
                    return $item->catalogue->citi_id ?? null;
                },
            ],
        ];
    }

}
