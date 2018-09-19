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
        'start_date' => 'date',
        'end_date' => 'date',
        'alt_event_types' => 'array',
        'alt_audiences' => 'array',
        'programs' => 'array',
    ];

    public function ticketedEvent()
    {

        return $this->belongsTo('App\Models\Membership\TicketedEvent', 'ticketed_event_id', 'membership_id');

    }

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'title_display',
                "doc" => "Name of this event formatted with HTML (optional)",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->title_display; },
            ],
            [
                "name" => 'event_type_id',
                "doc" => "Unique identifier indicating the preferred type of this event",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->type; },
            ],
            [
                "name" => 'alt_event_type_ids',
                "doc" => "Unique identifiers indicating the alternate types of this event",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->alt_event_types; },
            ],
            [
                "name" => 'audience_id',
                "doc" => "Unique identifier indicating the preferred audience for this event",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->audience; },
            ],
            [
                "name" => 'alt_audience_ids',
                "doc" => "Unique identifiers indicating the alternate audiences for this event",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->alt_audiences; },
            ],
            [
                "name" => 'program_ids',
                "doc" => "Unique identifiers indicating the programs this event is a part of",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->programs; },
            ],
            [
                "name" => 'short_description',
                "doc" => "Brief description of the event",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->short_description; },
            ],
            [
                "name" => 'header_description',
                "doc" => "Brief description of the event displayed below the title",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->header_description; },
            ],
            [
                "name" => 'list_description',
                "doc" => "One-sentence description of the event displayed in listings",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->list_description; },
            ],
            [
                "name" => 'description',
                "doc" => "All copy text of the event",
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
                "name" => 'image_url',
                "doc" => "The URL of an image representing this page",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->image_url; },
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
                "type" => "ISO 8601 date and time",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->start_date ? $this->start_date->toIso8601String() : null; },
            ],
            [
                "name" => 'end_date',
                "doc" => "The date the event ends",
                "type" => "ISO 8601 date and time",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->end_date ? $this->end_date->toIso8601String() : null; },
            ],
            [
                "name" => 'location',
                "doc" => "Where the event takes place",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->location; },
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
                "name" => 'event_type_id',
                "doc" => "Unique identifer of the preferred type for this event",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->event_type_id; },
            ],
            [
                "name" => 'ticketed_event_id',
                "doc" => "Unique identifier of the event in the ticketing system this website event is tied to",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->ticketedEvent ? $this->ticketedEvent->membership_id : NULL; },
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
