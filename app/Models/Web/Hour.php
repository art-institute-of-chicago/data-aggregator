<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * Hours on the website
 */
class Hour extends WebModel
{

    protected $casts = [
        'published' => 'boolean',
        'opening_time' => 'date',
        'closing_time' => 'date',
    ];

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'opening_time',
                "doc" => "The opening time on this day of the week",
                "type" => "ISO 8601 date and time",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->opening_time ? $this->opening_time->toIso8601String() : NULL; },
            ],
            [
                "name" => 'closing_time',
                "doc" => "The closing time on this day of the week",
                "type" => "ISO 8601 date and time",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->closing_time ? $this->closing_time->toIso8601String() : NULL; },
            ],
            // TODO: add documentation for `type` once we learn what it represents
            [
                "name" => 'type',
                "doc" => "(Not sure what this field is for)",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->type; },
            ],
            [
                "name" => 'day_of_week',
                "doc" => "Number indicating the day of the week",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->day_of_week; },
            ],
            [
                "name" => 'closed',
                "doc" => "Whether the museum is closed during these hours",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->closed; },
            ],
        ];

    }

}
