<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * Page on the website
 */
class Page extends WebModel
{

    protected $hasSourceDates = false;

    protected $casts = [
        'publish_start_date' => 'datetime',
        'publish_end_date' => 'datetime',
        'is_published' => 'boolean',
    ];

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'type',
                "doc" => "The type of page this record represents",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->type; },
            ],
            [
                "name" => 'web_url',
                "doc" => "The URL to this page on our website",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->web_url; },
            ],
            [
                "name" => 'slug',
                "doc" => "A human-readable string used in the URL",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->slug; },
            ],
            [
                "name" => 'listing_description',
                "doc" => "A brief description of the page used in listings",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->listing_description; },
            ],
            [
                "name" => 'short_description',
                "doc" => "A brief description of the page used in mobile and meta tags",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->short_description; },
            ],
            [
                "name" => 'is_published',
                "doc" => "Whether the page has been published",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->published; },
            ],
            [
                "name" => 'publish_start_date',
                "doc" => "The date a page was, or will be, published",
                "type" => "ISO 8601 date and time",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->publish_start_date ? $this->publish_start_date->toIso8601String() : null; },
            ],
            [
                "name" => 'publish_end_date',
                "doc" => "The date a page was, or will be, unpublished",
                "type" => "ISO 8601 date and time",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->publish_end_date ? $this->publish_end_date->toIso8601String() : null; },
            ],
            [
                "name" => 'copy',
                "doc" => "The text of the page",
                "type" => "string",
                "elasticsearch" => [
                    "default" => true,
                    "type" => 'text',
                ],
                "value" => function() { return $this->copy; },
            ],
            [
                "name" => 'image_url',
                "doc" => "The URL of an image representing this page",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->image_url; },
            ],
        ];

    }

}
