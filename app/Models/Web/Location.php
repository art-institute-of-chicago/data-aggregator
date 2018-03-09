<?php

namespace App\Models\Web;

use App\Models\WebModel;
use App\Models\Documentable;
use App\Models\ElasticSearchable;

/**
 * A campus building displayed on the website
 */
class Location extends WebModel
{

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'name',
                "doc" => "Name of the location",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->name; },
            ],
            [
                "name" => 'street',
                "doc" => "Street address of the location",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->street; },
            ],
            // TODO: add documentation for `address` once we learn how it differs from `street`
            [
                "name" => 'address',
                "doc" => "(We're unsure how this field differs from `street`)",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->address; },
            ],
            [
                "name" => 'city',
                "doc" => "Name of the city for this location",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->city; },
            ],
            [
                "name" => 'state',
                "doc" => "Name of the state for this location",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->state; },
            ],
            [
                "name" => 'zip',
                "doc" => "Zip code of the location",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->zip; },
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
