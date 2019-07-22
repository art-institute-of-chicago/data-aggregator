<?php

namespace App\Transformers\Outbound\Mobile;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class TourStop extends BaseTransformer
{

    protected $keyType = 'long';

    protected function getFields()
    {
        return [
            'weight' => [
                'doc' => 'Number representing this tour stop\'s sort order',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'web_url' => [
                'doc' => 'URL to the audio file for this tour stop',
                'type' => 'url',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return $item->sound->link ?? null;
                },
            ],
            'transcript' => [
                'doc' => 'Text transcription of the audio file',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                    'type' => 'text',
                ],
                'value' => function ($item) {
                    return $item->sound->transcript ?? null;
                },
            ],

            /**
             * TODO: Refactor relationships:
             */
            'artwork_id' => [
                'doc' => 'Unique identifier of the artwork for this tour stop',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->artwork->artwork->citi_id ?? null;
                },
            ],
            'artwork_title' => [
                'doc' => 'Name of the artwork for this tour stop',
                'type' => 'string',
                'elasticsearch' => 'text',
                'value' => function ($item) {
                    return $item->artwork->title ?? null;
                },
            ],
            'tour_id' => [
                'doc' => 'Unique identifier of the tour this stop is a part of',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->tour->mobile_id ?? null;
                },
            ],
            'tour_title' => [
                'doc' => 'Name of the tour this stop is a part of',
                'type' => 'string',
                'elasticsearch' => 'text',
                'value' => function ($item) {
                    return $item->tour->title ?? null;
                },
            ],
        ];
    }

}
