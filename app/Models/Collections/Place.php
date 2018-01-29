<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

/**
 * A room or hall that works of art are displayed in.
 */
class Place extends CollectionsModel
{

    use ElasticSearchable;
    use Documentable;

    protected $primaryKey = 'citi_id';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];

    public function categories()
    {

        return $this->belongsToMany('App\Models\Collections\Category');

    }

    /**
     * Scope a query to only include galleries
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGalleries($query)
    {

        return $query->where('type', 'AIC Gallery');

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
                "value" => function() { return $this->latitude .',' .$this->longitude; },
            ],
            [
                "name" => 'category_ids',
                "doc" => "Unique identifiers of the categories this place is a part of",
                "type" => "number",
                'elasticsearch_type' => 'integer',
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

            [
                "name" => 'category_titles',
                "doc" => "Names of the categories this place is a part of",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->categories->pluck('title')->all(); },
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

        return "26772";

    }

}
