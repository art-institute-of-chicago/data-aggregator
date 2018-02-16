<?php

namespace App\Models\Membership;

use App\Models\MembershipModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

/**
 * An occurrence of a program at the museum.
 */
class TicketedEvent extends MembershipModel
{

    use ElasticSearchable;
    use Documentable;

    protected $dates = [
        'start_at',
        'end_at',
        'source_created_at',
        'source_modified_at',
    ];

    public function resource2gallery( $resource_id )
    {

        $locations = [
            '3' => 26131, // Rubloff Auditorium
            '4' => 28277, // Price Auditorium
            '5' => 28276, // Morton Auditorium
            '10' => 24000, // Griffin Court
            '11' => 2147475902, // Regenstein Hall
            '22' => 23998, // Abbott Galleries (Galleries 182-184, this is Gallery 183)
            '23' => 2147483599, // Fullerton Hall
            '49' => 23965, // Cafe Moderno
            '50' => 25563, // Terzo Piano
            '77' => 2147475902, // Regenstein Hall Thursday
            '80' => 25237, // Pritzker Garden
            '81' => 346, // Stock Exchange Trading Room
            '82' => 2147477257, // Gallery 11
            '83' => 2147472011, // Grand Staircase
            '86' => 27946, // South Garden
            '87' => 2147477076, // North Garden
        ];

        $resource_id = (string) $resource_id;

        return $locations[ $resource_id ] ?? null;
    }

    protected function getExtraFillFieldsFrom($source)
    {

        return [

            'start_at' => strtotime($source->start_at),
            'end_at' => strtotime($source->end_at),

        ];

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

        ];

    }


    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "28990343";

    }

}
