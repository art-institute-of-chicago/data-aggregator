<?php

namespace App\Models\Web;

use App\Models\WebModel;
use App\Models\Documentable;
use App\Models\ElasticSearchable;

/**
 * An event on the website
 */
class Event extends WebModel
{

    protected $casts = [
        'published' => 'boolean',
        'is_private' => 'boolean',
        'is_after_hours' => 'boolean',
        'is_ticketed' => 'boolean',
        'is_free' => 'boolean',
        'is_member_exclusive' => 'boolean',
        'is_admission_required' => 'boolean',
        'hidden' => 'boolean',
        'all_dates' => 'array',
    ];

    public function ticketedEvent()
    {

        return $this->belongsTo('App\Models\Membership\TicketedEvent');

    }

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'type',
                "doc" => "Number indicating the type of event",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->type; },
            ],
            [
                "name" => 'short_description',
                "doc" => "Brief description of the event",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->short_description; },
            ],
            [
                "name" => 'description',
                "doc" => "Description of the event",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->description; },
            ],
            [
                "name" => 'hero_caption',
                "doc" => "Text displayed with the hero image on the event",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->hero_caption; },
            ],
            [
                "name" => 'is_private',
                "doc" => "Whether the event is private",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->is_private; },
            ],
            [
                "name" => 'is_after_hours',
                "doc" => "Whether the event is to be held after the museum closes",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->is_after_hours; },
            ],
            [
                "name" => 'is_ticketed',
                "doc" => "Whether a ticket is required to attend the event",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->is_ticketed; },
            ],
            [
                "name" => 'is_free',
                "doc" => "Whether the event is free",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->is_free; },
            ],
            [
                "name" => 'is_member_exclusive',
                "doc" => "Whether the event is exclusive to members of the museum",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->is_member_exclusive; },
            ],
            [
                "name" => 'hidden',
                "doc" => "Whether the event should appear in listings and in search",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return (bool) $this->hidden; },
            ],
            [
                "name" => 'rsvp_link',
                "doc" => "The URL to the sales site for this event",
                "type" => "url",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->rsvp_link; },
            ],
            [
                "name" => 'start_date',
                "doc" => "The date the event begins",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->start_date; },
            ],
            [
                "name" => 'end_date',
                "doc" => "The date the event ends",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->end_date; },
            ],
            [
                "name" => 'all_dates',
                "doc" => "All the dates this event takes place",
                "type" => "array",
                "value" => function() { return $this->all_dates; },
            ],
            [
                "name" => 'location',
                "doc" => "Where the event takes place",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->location; },
            ],
            [
                "name" => 'sponsors_description',
                "doc" => "A description of who sponsors the event",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->sponsors_description; },
            ],
            [
                "name" => 'sponsors_sub_copy',
                "doc" => "Further details on who sponsors the event",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->sponsors_sub_copy; },
            ],
            [
                "name" => 'layout_type',
                "doc" => "Number indicating the type of layout this event page uses",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->layout_type; },
            ],
            [
                "name" => 'buy_button_text',
                "doc" => "The text used on the ticket/registration button",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->buy_button_text; },
            ],
            [
                "name" => 'buy_button_caption',
                "doc" => "Additional text below the ticket/registration button",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->buy_button_caption; },
            ],
            [
                "name" => 'is_admission_required',
                "doc" => "Whether admission to the museum is required to attend this event",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->is_admission_required; },
            ],
            [
                "name" => 'ticketed_event_id',
                "doc" => "Unique identifer of the event in the ticketing system this website event is tied to",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->ticketedEvent ? $this->ticketedEvent->id : NULL; },
            ],
            [
                "name" => 'survey_url',
                "doc" => "URL to the survey associated with this event",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->survey_url; },
            ],
            [
                "name" => 'email_series',
                "doc" => "The email series associated with this event",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->email_series; },
            ],
            [
                "name" => 'door_time',
                "doc" => "The time the doors open for this event",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->door_time; },
            ],
            [
                "name" => 'published',
                "doc" => "Whether the location is published on the website",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->published; },
            ],
        ];

    }

}
