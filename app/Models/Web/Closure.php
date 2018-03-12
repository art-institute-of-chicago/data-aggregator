<?php

namespace App\Models\Web;

use App\Models\WebModel;
use App\Models\Documentable;
use App\Models\ElasticSearchable;

/**
 * Closure on the website
 */
class Closure extends WebModel
{

    protected $casts = [
        'source_created_at' => 'date',
        'source_modified_at' => 'date',
        'published' => 'boolean',
        'date_start' => 'date',
        'date_end' => 'date',
    ];

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'date_start',
                "doc" => "The date the closure begins",
                "type" => "ISO 8601 date and time",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->date_start ? $this->date_start->toIso8601String() : NULL; },
            ],
            [
                "name" => 'date_end',
                "doc" => "The date the closure ends",
                "type" => "ISO 8601 date and time",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->date_end ? $this->date_end->toIso8601String() : NULL; },
            ],
            [
                "name" => 'closure_copy',
                "doc" => "Description of the closure",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->closure_copy; },
            ],
            [
                "name" => 'type',
                "doc" => "Number indicating the type of closure",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->type; },
            ],
        ];

    }

}
