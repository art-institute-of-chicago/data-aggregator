<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * A tag on the website
 */
class Tag extends WebModel
{

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'name',
                "doc" => "Name of the tag",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->name; },
            ],
        ];

    }

}
