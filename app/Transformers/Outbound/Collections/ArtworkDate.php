<?php

namespace App\Transformers\Outbound\Collections;

use App\Transformers\Outbound\Collections\Traits\HidesDefaultFields;

use App\Transformers\Outbound\CollectionsTransformer as BaseTransformer;

class ArtworkDate extends BaseTransformer
{
    use HidesDefaultFields;

    protected function getFields()
    {
        return [
            'is_preferred' => [
                'doc' => 'Whether this is the preferred place to represent this work',
                'type' => 'boolean',
            ],
            'date_earliest' => [
                'doc' => 'Start or earliest possible date, if estimated',
                'type' => 'string',
                'value' => $this->getDateValue('date_earliest'),
            ],
            'date_latest' => [
                'doc' => 'End or latest possible date, if estimated',
                'type' => 'number',
                'value' => $this->getDateValue('date_latest'),
            ],

            // TODO: Refactor relationships:
            'artwork_title' => [
                'doc' => 'Name of the work associated with this place',
                'type' => 'string',
                'value' => function ($item) {
                    return $item->artwork->title ?? null;
                },
            ],
            'artwork_id' => [
                'doc' => 'Unique identifier of the work associated with this place',
                'type' => 'number',
                'value' => function ($item) {
                    return $item->artwork->id ?? null;
                },
            ],
            'qualifier_title' => [
                'doc' => 'Name of the qualifier indicating what happened to the work here',
                'type' => 'string',
                'value' => function ($item) {
                    return $item->qualifier->title ?? null;
                },
            ],
            'qualifier_id' => [
                'doc' => 'Unique identifier of the qualifier indicating what happened to the work here',
                'type' => 'number',
                'value' => function ($item) {
                    return $item->qualifier->id ?? null;
                },
            ],
        ];
    }
}
