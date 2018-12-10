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

    public function categories()
    {

        return $this->belongsToMany('App\Models\Collections\Category');

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
            [
                "name" => 'category_titles',
                "doc" => "Names of the categories this place is a part of",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->categories->pluck('title')->all(); },
            ],
        ];

    }

}
