<?php

namespace App\Transformers\Outbound\Mobile;

use App\Transformers\Outbound\Mobile\Sound as SoundTransformer;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

use App\Transformers\Traits\ConvertsToHtml;

class TourStop extends BaseTransformer
{

    use ConvertsToHtml;

    protected function getFields()
    {
        return [
            // TODO: Determine if tour stops have dedicated titles?
            'title' => [
                'doc' => 'Name of this tour stop – derived from the artwork and tour titles',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                    'type' => 'text',
                ],
                'value' => function ($item) {
                    $title = $item->artwork->title ?? null;
                    $title .= ($item->tour->title ?? false) ? ' (' . $item->tour->title . ')' : null;
                    return $title;
                },
            ],
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
                    return $this->convertToHtml($item->sound->transcript ?? null);
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
