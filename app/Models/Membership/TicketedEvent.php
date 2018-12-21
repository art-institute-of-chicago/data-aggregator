<?php

namespace App\Models\Membership;

use App\Models\MembershipModel;
use App\Models\ElasticSearchable;

use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

/**
 * An occurrence of a program at the museum.
 */
class TicketedEvent extends MembershipModel
{

    use ElasticSearchable {
        getDefaultSearchFields as public traitGetDefaultSearchFields;
    }

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'on_sale_at' => 'datetime',
        'off_sale_at' => 'datetime',
    ];

    public function event()
    {

        return $this->hasOne('App\Models\Web\Event', 'ticketed_event_id', 'membership_id');

    }

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [

            [
                "name" => 'image',
                "doc" => "URL to an image representing this event",
                "type" => "url",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->image_url; },
            ],
            [
                "name" => 'start_at',
                "doc" => "Date and time the event begins",
                "type" => "ISO 8601 date and time",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->start_at ? $this->start_at->toIso8601String() : NULL; },
            ],
            [
                "name" => 'end_at',
                "doc" => "Date and time the event ends",
                "type" => "ISO 8601 date and time",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->end_at ? $this->end_at->toIso8601String() : NULL; },
            ],
            [
                "name" => 'on_sale_at',
                "doc" => "Date and time the event goes on sale",
                "type" => "ISO 8601 date and time",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->on_sale_at ? $this->on_sale_at->toIso8601String() : NULL; },
            ],
            [
                "name" => 'off_sale_at',
                "doc" => "Date and time the event goes off sale",
                "type" => "ISO 8601 date and time",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->off_sale_at ? $this->off_sale_at->toIso8601String() : NULL; },
            ],
            [
                "name" => 'ticketed_event_type_id',
                "doc" => "Unique identifier of the event type in the ticketing system this website event is tied to",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->event_type_id ?: NULL; },
            ],
            [
                "name" => 'resource_id',
                "doc" => "Unique identifier of the resource associated with this event, often the venue in which it takes place",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->resource_id; },
            ],
            [
                "name" => 'resource_title',
                "doc" => "The name of the resource associated with this event, often the venue in which it takes place",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->resource_title; },
            ],

            // Caution: (bool) null = false
            // TODO: Use $casts throughout the codebase
            [
                "name" => 'is_after_hours',
                "doc" => "Whether the event takes place after museum hours",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return (bool) $this->is_after_hours; },
            ],
            [
                "name" => 'is_private_event',
                "doc" => "Whether the event is open to public",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return (bool) $this->is_private_event; },
            ],
            [
                "name" => 'is_admission_required',
                "doc" => "Whether admission is required in order to attend the event",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return (bool) $this->is_admission_required; },
            ],
            [
                "name" => 'available',
                "doc" => "Number indicating how many tickets are available for the event",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->available; },
            ],
            [
                "name" => 'total_capacity',
                "doc" => "Number indicating the total number of tickets that can be sold for the event",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->total_capacity; },
            ],
            [
                "name" => 'event_id',
                "doc" => "Unique identifier of web events associated with this ticketed event",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->event->id ?? NULL; },
            ],

        ];

    }

    public function searchableImage()
    {

        return $this->image_url;

    }

    public function getDefaultSearchFields()
    {

        $fields = $this->traitGetDefaultSearchFields();

        return array_merge(['api_id^1.0'], $fields);

    }
}
