<?php

namespace App\Transformers\Outbound\Mobile;

use App\Transformers\Outbound\Mobile\Sound as SoundTransformer;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class TourStop extends BaseTransformer
{

    protected $availableIncludes = ['sound'];

    protected $defaultIncludes = ['sound'];

    public function includeSound($tourStop)
    {
        return $this->item($tourStop->sound, new SoundTransformer, false);
    }

    protected function getFields()
    {
        return [
            // TODO: Determine if tour stops have dedicated titles?
            'title' => [
                'doc' => 'Name of this tour stop – derived from the artwork title',
                'type' => 'string',
                'elasticsearch' => 'text',
                'value' => function ($item) {
                    return $item->artwork->title ?? null;
                },
            ],
            'weight' => [
                'doc' => 'Number representing this tour stop\'s sort order',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'artwork_title' => [
                'doc' => 'Name of the artwork for this tour stop',
                'type' => 'string',
                'elasticsearch' => 'text',
                'value' => function ($item) {
                    return $item->artwork->title ?? null;
                },
            ],
            'artwork_id' => [
                'doc' => 'Unique identifier of the artwork for this tour stop',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->artwork->artwork->citi_id ?? null;
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
            'mobile_sound' => [
                'doc' => 'URL to the audio file for this tour stop',
                'type' => 'url',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return $item->sound->link ?? null;
                },
            ],
            'mobile_sound_id' => [
                'doc' => 'Unique identifier of the audio file for this tour stop',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->sound->mobile_id ?? null;
                },
            ],
        ];
    }

}
