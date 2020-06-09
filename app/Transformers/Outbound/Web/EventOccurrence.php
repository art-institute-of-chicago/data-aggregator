<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class EventOccurrence extends BaseTransformer
{

    /**
     * Event occurrences use UUIDs, not integers.
     *
     * @var string
     */
    protected $keyType = 'keyword';

    protected function getFields()
    {
        return [
            'event_id' => [
                'doc' => 'Identifier of the master event of which this is an occurrence',
                'type' => 'integer',
                'elasticsearch' => 'integer',
            ],
            'short_description' => [
                'doc' => 'Brief description of the event',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'description' => [
                'doc' => 'Description of the event',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                    'type' => 'text',
                ],
            ],
            'image_url' => [
                'doc' => 'The URL of an image representing this page',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            /*
            // TODO: Re-enable this field after fixing image_caption truncation [WEB-507]
            'image_caption' => [
                'doc' => 'Text displayed with the hero image on the event',
                'type' => 'string',
                'elasticsearch' => 'text',
                'value' => function ($item) {
                    return $item->image_caption;
                },
            ],
            */
            'is_private' => [
                'doc' => 'Whether the event is private. Private events should be omitted from listings.',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'start_at' => [
                'doc' => 'The date the event occurrence begins',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
                'value' => $this->getDateValue('start_at'),
            ],
            'end_at' => [
                'doc' => 'The date the event occurrence ends',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
                'value' => $this->getDateValue('end_at'),
            ],
            'location' => [
                'doc' => 'Where the event takes place',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'button_url' => [
                'doc' => 'The URL to the sales site or an RSVP link for this event',
                'type' => 'url',
                'elasticsearch' => 'keyword',
            ],
            'button_text' => [
                'doc' => 'The text used on the ticket/registration button',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'button_caption' => [
                'doc' => 'Additional text below the ticket/registration button',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
        ];
    }

}
