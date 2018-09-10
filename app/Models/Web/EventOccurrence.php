<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * An occurrence of an event on the website
 */
class EventOccurrence extends WebModel
{

    public $incrementing = true;

    protected $casts = [
        'is_private' => 'boolean',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function event()
    {

        return $this->belongsTo('App\Models\Membership\Event');

    }

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'event_id',
                "doc" => "Identifier of the master event of which this is an occurrence",
                "type" => "integer",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->event_id; },
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
                "elasticsearch" => [
                    "default" => true,
                    "type" => 'text',
                ],
                "value" => function() { return $this->description; },
            ],
            [
                "name" => 'image_url',
                "doc" => "The URL of an image representing this page",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->image_url; },
            ],
            /*
            // TODO: Re-enable this field after fixing image_caption truncation [WEB-507]
            [
                "name" => 'image_caption',
                "doc" => "Text displayed with the hero image on the event",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->image_caption; },
            ],
            */
            [
                "name" => 'is_private',
                "doc" => "Whether the event is private. Private events should be omitted from listings.",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->is_private; },
            ],
            [
                "name" => 'start_at',
                "doc" => "The date the event occurrence begins",
                "type" => "ISO 8601 date and time",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->start_at ? $this->start_at->toIso8601String() : null; },
            ],
            [
                "name" => 'end_at',
                "doc" => "The date the event occurrence ends",
                "type" => "ISO 8601 date and time",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->end_at ? $this->end_at->toIso8601String() : null; },
            ],
            [
                "name" => 'location',
                "doc" => "Where the event takes place",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->location; },
            ],
            [
                "name" => 'button_url',
                "doc" => "The URL to the sales site or an RSVP link for this event",
                "type" => "url",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->button_url; },
            ],
            [
                "name" => 'button_text',
                "doc" => "The text used on the ticket/registration button",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->button_text; },
            ],
            [
                "name" => 'button_caption',
                "doc" => "Additional text below the ticket/registration button",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->button_caption; },
            ],
        ];

    }

}
