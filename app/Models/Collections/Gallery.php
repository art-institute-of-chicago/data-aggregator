<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

/**
 * A room or hall that works of art are displayed in.
 */
class Gallery extends CollectionsModel
{

    use ElasticSearchable;
    use Documentable;

    protected $primaryKey = 'citi_id';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];

    public function categories()
    {

        return $this->belongsToMany('App\Models\Collections\Category');

    }

    public function getFillFieldsFrom($source)
    {

        return [
            'closed' => $source->closed,
            'number' => $source->number,
            'floor' => $source->floor,
            'latitude' => $source->latitude,
            'longitude' => $source->longitude,
        ];

    }


    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'is_closed',
                "doc" => "Whether the gallery is currently closed",
                "type" => "boolean",
                "value" => function() { return (bool) $this->closed; }
            ],
            [
                "name" => 'number',
                "doc" => "The gallery's room number. For 'Gallery 100A', this would be '100A'.",
                "type" => "string",
                "value" => function() { return $this->number; },
            ],
            [
                "name" => 'floor',
                "doc" => "The level the gallery is on, e.g., 1, 2, 3, or LL",
                "type" => "string",
                "value" => function() { return $this->floor; },
            ],
            [
                "name" => 'latitude',
                "doc" => "Latitude coordinate of the center of the room",
                "type" => "number",
                "value" => function() { return $this->latitude; },
            ],
            [
                "name" => 'longitude',
                "doc" => "Longitude coordinate of the center of the room",
                "type" => "number",
                "value" => function() { return $this->longitude; },
            ],
            [
                "name" => 'latlon',
                "doc" => "Latitude and longitude coordinates of the center of the room",
                "type" => "string",
                "value" => function() { return $this->latitude .',' .$this->longitude; },
            ],
            [
                "name" => 'category_ids',
                "doc" => "Unique identifiers of the categories this gallery is a part of",
                "type" => "number",
                "value" => function() { return $this->categories->pluck('citi_id')->all(); },
            ],
        ];

    }


    /**
     * Turn the titles for related models into a generic array
     *
     * @return array
     */
    protected function transformTitles()
    {

        return [

            'category_titles' => $this->categories->pluck('title')->all(),

        ];

    }


    /**
     * Generate model-specific fields for an array representing the schema for this object.
     *
     * @return array
     */
    public function elasticsearchMappingFields()
    {

        return
            [
                'is_closed' => [
                    'type' => 'boolean',
                ],
                'number' => [
                    'type' => 'keyword',
                ],
                'floor' => [
                    'type' => 'keyword',
                ],
                'latitude' => [
                    'type' => 'float',
                ],
                'longitude' => [
                    'type' => 'float',
                ],
                'latlon' => [
                    'type' => 'geo_point',
                ],
                'category_ids' => [
                    'type' => 'integer',
                ],
                'category_titles' => [
                    'type' => 'text',
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

        return "24650";

    }

}
