<?php

namespace App\Transformers\Outbound\Collections;

use App\Transformers\Outbound\Collections\Place as BaseTransformer;
use App\Transformers\Outbound\Collections\Traits\IsCC0;

class Gallery extends BaseTransformer
{

    use IsCC0;

    protected function getFields()
    {
        $galleryFields = [
            'is_closed' => [
                'doc' => 'Whether the gallery is currently closed',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'number' => [
                'doc' => 'The gallery\'s room number. For "Gallery 100A", this would be "100A".',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'floor' => [
                'doc' => 'The level the gallery is on, e.g., 1, 2, 3, or LL',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'latitude' => [
                'doc' => 'Latitude coordinate of the center of the room',
                'type' => 'number',
                'elasticsearch' => 'float',
            ],
            'longitude' => [
                'doc' => 'Longitude coordinate of the center of the room',
                'type' => 'number',
                'elasticsearch' => 'float',
            ],
            'latlon' => [
                'doc' => 'Latitude and longitude coordinates of the center of the room',
                'type' => 'string',
                'elasticsearch' => 'geo_point',
                'value' => function ($item) {
                    if ($item->latitude && $item->longitude) {
                        return $item->latitude . ',' . $item->longitude;
                    }
                },
            ],
        ];

        return array_merge(
            parent::getFields(),
            $galleryFields
        );
    }

}
