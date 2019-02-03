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
        ];

    }

    public static function validateId( $id )
    {

        return is_numeric($id);

    }
}
