<?php

namespace App\Transformers\Outbound\Web;

use App\Models\Web\EventProgram;
use App\Transformers\Outbound\Web\Traits\HasSearchTags;
use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Event extends BaseTransformer
{
    use HasSearchTags;

    protected function getTitles()
    {
        return array_merge(parent::getTitles(), [
            'title_display' => [
                'doc' => 'The name of this event formatted with HTML (optional)',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
        ]);
    }

    protected function getFields()
    {
        return [
            'image_url' => [
                'doc' => 'The URL of an image representing this page',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'hero_caption' => [
                'doc' => 'Text displayed with the hero image on the event',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'short_description' => [
                'doc' => 'Brief description of the event',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'header_description' => [
                'doc' => 'Brief description of the event displayed below the title',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'list_description' => [
                'doc' => 'One-sentence description of the event displayed in listings',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'description' => [
                'doc' => 'All copytext of the event',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                ],
            ],
            'location' => [
                'doc' => 'Where the event takes place',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],

            /**
             * JSON fields, not true relationships:
             */
            'event_type_id' => [
                'doc' => 'Unique identifier indicating the preferred type of this event',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->type;
                },
            ],
            'alt_event_type_ids' => [
                'doc' => 'Unique identifiers indicating the alternate types of this event',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->alt_event_types;
                },
            ],
            'audience_id' => [
                'doc' => 'Unique identifier indicating the preferred audience for this event',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->audience;
                },
            ],
            'alt_audience_ids' => [
                'doc' => 'Unique identifiers indicating the alternate audiences for this event',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->alt_audiences;
                },
            ],
            'program_ids' => [
                'doc' => 'Unique identifiers indicating the programs this event is a part of',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->programs;
                },
            ],
            'program_titles' => [
                'doc' => 'Titles of the programs this event is a part of',
                'type' => 'array',
                'elasticsearch' => [
                    'default' => true,
                ],
                'value' => function ($item) {
                    if ($item->programs) {
                        return EventProgram::find($item->programs)->pluck('title');
                    }

                    return [];
                },
            ],

            /**
             * Other form fields:
             */
            'is_ticketed' => [
                'doc' => 'Whether a ticket is required to attend the event',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'ticketed_event_id' => [
                'doc' => 'Unique identifier of the event in the ticketing system this website event is tied to',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->ticketedEvent->id ?? null;
                },
                'is_restricted' => self::RESTRICTED_IN_DUMP,
            ],
            'rsvp_link' => [
                'doc' => 'The URL to the sales site for this event',
                'type' => 'url',
                'elasticsearch' => 'keyword',
            ],
            'buy_button_text' => [
                'doc' => 'The text used on the ticket/registration button',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'buy_button_caption' => [
                'doc' => 'Additional text below the ticket/registration button',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'is_registration_required' => [
                'doc' => 'Whether registration is required to attend the event',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'is_member_exclusive' => [
                'doc' => 'Whether the event is exclusive to members of the museum',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'is_sold_out' => [
                'doc' => 'Whether the event is sold out',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
                'value' => function ($item) {
                    return $item->is_sold_out || ($item->ticketedEvent->available ?? 1) < 1;
                },
            ],
            'is_free' => [
                'doc' => 'Whether the event is free',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'is_private' => [
                'doc' => 'Whether the event is private',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
                'is_restricted' => self::RESTRICTED_IN_DUMP,
            ],
            'is_admission_required' => [
                'doc' => 'Whether admission to the museum is required to attend this event',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'is_after_hours' => [
                'doc' => 'Whether the event is to be held after the museum closes',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'is_sales_button_hidden' => [
                'doc' => 'Whether the buy tickets button is hidden on the website event page',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'is_virtual_event' => [
                'doc' => 'Whether the event is being held virtually',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'virtual_event_url' => [
                'doc' => 'URL to the virtual event',
                'type' => 'string',
                'elasticsearch' => 'text',
                'is_restricted' => self::RESTRICTED_IN_DUMP,
            ],
            'virtual_event_passcode' => [
                'doc' => 'Passcode to access the virtual event',
                'type' => 'string',
                'elasticsearch' => 'text',
                'is_restricted' => self::RESTRICTED_IN_DUMP,
            ],
            'start_date' => [
                'doc' => 'The date the event begins',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
                'value' => $this->getDateValue('start_date'),
            ],
            'end_date' => [
                'doc' => 'The date the event ends',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
                'value' => $this->getDateValue('end_date'),
            ],
            'start_time' => [
                'doc' => 'The time the event starts',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'end_time' => [
                'doc' => 'The time the event ends',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'date_display' => [
                'doc' => 'A readable display of the event dates',
                'type' => 'string',
                'elasticsearch' => 'text',
                'value' => function ($item) {
                    return $item->forced_date;
                },
            ],
            'door_time' => [
                'doc' => 'The time the doors open for this event',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'layout_type' => [
                'doc' => 'Number indicating the type of layout this event page uses',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'slug' => [
                'doc' => 'A string used in the URL for this event',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'entrance' => [
                'doc' => 'Which entrance to use for this event',
                'type' => 'string',
            ],
            'join_url' => [
                'doc' => 'URL to the membership signup page via this event',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'survey_url' => [
                'doc' => 'URL to the survey associated with this event',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'event_host_id' => [
                'doc' => 'Unique identifier of the host (cf. event programs) that is presenting this event',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->eventHost->id ?? null;
                },
            ],
            'event_host_title' => [
                'doc' => 'Unique identifier of the host (cf. event programs) that is presenting this event',
                'type' => 'string',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return $item->eventHost->title ?? null;
                },
            ],
        ];
    }
}
