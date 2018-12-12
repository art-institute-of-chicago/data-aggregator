<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * Article on the website
 */
class Article extends WebModel
{

    protected $casts = [
        'published' => 'boolean',
        'date' => 'date',
    ];

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'date',
                "doc" => "The date the article was published",
                "type" => "ISO 8601 date and time",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->date ? $this->date->toIso8601String() : NULL; },
            ],
            [
                "name" => 'copy',
                "doc" => "The text of the article",
                "type" => "string",
                "elasticsearch" => [
                    "default" => true,
                    "type" => 'text',
                ],
                "value" => function() { return $this->copy; },
            ],
        ];

    }

}
