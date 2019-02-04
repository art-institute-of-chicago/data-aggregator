<?php

namespace App\Transformers\Outbound\Membership;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class LegacyEvent extends BaseTransformer
{

    protected function getFields()
    {
        return [
            'description' => [
                'doc' => 'Long description of the event',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                    'type' => 'text',
                ],
                'value' => function ($item) {
                    return $item->description ?: null;
                },
            ],
            'short_description' => [
                'doc' => 'Short description of the event',
                'type' => 'string',
                'elasticsearch' => 'text',
                'value' => function ($item) {
                    return trim($item->short_description) ?: null;
                },
            ],
            'image' => [
                'doc' => 'URL to an image representing this event',
                'type' => 'url',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return $item->image_url ?: null;
                },
            ],
            'type' => [
                'doc' => 'The name of the type of event',
                'type' => 'string',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return $item->type ?: null;
                },
            ],
            'start_at' => [
                'doc' => 'Date and time the event begins',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
                'value' => $this->getDateValue('start_at'),
            ],
            'end_at' => [
                'doc' => 'Date and time the event ends',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
                'value' => $this->getDateValue('end_at'),
            ],
            'location' => [
                'doc' => 'Location of the event (freetext)',
                'type' => 'string',
                'value' => function ($item) {
                    return $item->resource_title ?: null;
                },
            ],
            'exhibition_ids' => [
                'doc' => 'Unique identifiers of the exhibitions associated with this work',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->exhibitions->pluck('citi_id')->all();
                },
            ],
            'button_text' => [
                'doc' => 'Name of text on the CTA to buy tickets/register',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'button_url' => [
                'doc' => 'URL of the CTA to buy tickets/register',
                'type' => 'url',
                'elasticsearch' => 'keyword',
            ],
        ];
    }

}
