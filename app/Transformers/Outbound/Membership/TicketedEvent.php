<?php

namespace App\Transformers\Outbound\Membership;

use App\Transformers\Outbound\Web\Event as EventTransformer;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class TicketedEvent extends BaseTransformer
{
    protected $availableIncludes = [
        'event',
    ];

    /**
     * WEB-118: Work-around for null relations?
     */
    public function includeEvent($ticketedEvent)
    {
        return $ticketedEvent->event ? $this->item($ticketedEvent->event, new EventTransformer(), false) : null;
    }

    /**
     * WEB-542: Give the `id` field an `id.text` subfield for default text search.
     */
    protected function getIds()
    {
        $fields = parent::getIds();

        $fields['id']['elasticsearch'] = [
            'mapping' => [
                'type' => $this->keyType,
                'fields' => [
                    'text' => [
                        'type' => 'text',
                    ],
                ],
            ],
        ];

        return $fields;
    }

    protected function getFields()
    {
        return [
            'image' => [
                'doc' => 'URL to an image representing this event',
                'type' => 'url',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return $item->image_url;
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
            'on_sale_at' => [
                'doc' => 'Date and time the event goes on sale',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
                'value' => $this->getDateValue('on_sale_at'),
            ],
            'off_sale_at' => [
                'doc' => 'Date and time the event goes off sale',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
                'value' => $this->getDateValue('off_sale_at'),
            ],
            'available' => [
                'doc' => 'Number indicating how many tickets are available for the event',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'total_capacity' => [
                'doc' => 'Number indicating the total number of tickets that can be sold for the event',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'is_after_hours' => [
                'doc' => 'Whether the event takes place after museum hours',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'is_private_event' => [
                'doc' => 'Whether the event is open to public',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'is_admission_required' => [
                'doc' => 'Whether admission is required in order to attend the event',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],

            // Relationships to stuff not in our system. Safe to remove?
            'resource_id' => [
                'doc' => 'Unique identifier of the resource associated with this event, often the venue in which it takes place',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'resource_title' => [
                'doc' => 'The name of the resource associated with this event, often the venue in which it takes place',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],

            // TODO: Refactor relationships:
            'ticketed_event_type_id' => [
                'doc' => 'Unique identifier of the event type in the ticketing system this website event is tied to',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->event_type_id ?? null;
                },
            ],
            'event_id' => [
                'doc' => 'Unique identifier of web events associated with this ticketed event',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->event->id ?? null;
                },
            ],
        ];
    }
}
