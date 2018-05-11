<?php

namespace App\Models\Web;

use App\Models\WebModel;
use App\Models\Documentable;
use App\Models\ElasticSearchable;

/**
 * Selections are a grouping of artworks on the website
 */
class Selection extends WebModel
{

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'short_copy',
                "doc" => "A brief summary of what is contained in the selection",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->short_copy; },
            ],
            [
                "name" => 'copy',
                "doc" => "The text of the selection description",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->copy; },
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
