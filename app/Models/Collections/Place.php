<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;

/**
 * A room or hall that works of art are displayed in.
 */
class Place extends CollectionsModel
{

    use ElasticSearchable;

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

    public static function validateId( $id )
    {

        return is_numeric($id);

    }
}
