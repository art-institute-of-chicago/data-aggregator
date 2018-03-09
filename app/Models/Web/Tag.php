<?php

namespace App\Models\Web;

use App\Models\BaseModel;
use App\Models\Documentable;
use App\Models\ElasticSearchable;

/**
 * A tag on the website
 */
class Tag extends BaseModel
{

    use Documentable, ElasticSearchable;

    protected $casts = [
        'source_created_at' => 'date',
        'source_modified_at' => 'date',
    ];

    protected static $source = 'Web';

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
