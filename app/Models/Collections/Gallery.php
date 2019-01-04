<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;

/**
 * A room or hall that works of art are displayed in.
 */
class Gallery extends CollectionsModel
{

    use ElasticSearchable;

    protected $primaryKey = 'citi_id';

    protected $touches =[
        'artworks',
    ];

    public function categories()
    {

        return $this->belongsToMany('App\Models\Collections\Category', 'category_place', 'place_citi_id', 'category_lake_uid');

    }

    public function artworks()
    {

        return $this->hasMany('App\Models\Collections\Artwork');

    }


    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'type',
                "doc" => "Type always takes one of the following values: AIC Gallery, AIC Storage, null",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->type; },
            ],
            [
                "name" => 'is_closed',
                "doc" => "Whether the gallery is currently closed",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return (bool) $this->closed; }
            ],
            [
                "name" => 'number',
                "doc" => "The gallery's room number. For 'Gallery 100A', this would be '100A'.",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->number; },
            ],
            [
                "name" => 'floor',
                "doc" => "The level the gallery is on, e.g., 1, 2, 3, or LL",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->floor; },
            ],
            [
                "name" => 'latitude',
                "doc" => "Latitude coordinate of the center of the room",
                "type" => "number",
                'elasticsearch_type' => 'float',
                "value" => function() { return $this->latitude; },
            ],
            [
                "name" => 'longitude',
                "doc" => "Longitude coordinate of the center of the room",
                "type" => "number",
                'elasticsearch_type' => 'float',
                "value" => function() { return $this->longitude; },
            ],
            [
                "name" => 'latlon',
                "doc" => "Latitude and longitude coordinates of the center of the room",
                "type" => "string",
                'elasticsearch_type' => 'geo_point',
                "value" => function() {
                    if ($this->latitude && $this->longitude)
                    {
                        return $this->latitude . ',' . $this->longitude;
                    }
                },
            ],
            [
                "name" => 'category_ids',
                "doc" => "Unique identifiers of the categories this gallery is a part of",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->categories->pluck('lake_uid')->all(); },
            ],
            [
                "name" => 'category_titles',
                "doc" => "Names of the categories this gallery is a part of",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->categories->pluck('title')->all(); },
            ],
        ];

    }

}
