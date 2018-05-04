<?php

namespace App\Models\Web;

use App\Models\WebModel;
use App\Models\Documentable;
use App\Models\ElasticSearchable;

/**
 * Article on the website
 */
class Artist extends WebModel
{

    public $table = 'web_artists';

    protected $apiCtrl = 'WebArtistsController';

    protected $casts = [
        'published' => 'boolean',
        'also_known_as' => 'boolean',
    ];

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'has_also_known_as',
                "doc" => "Whether the artist will display multiple names",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->also_known_as; },
            ],
            [
                "name" => 'intro_copy',
                "doc" => "Description of the artist",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->intro_copy; },
            ],
            [
                "name" => 'agent_id',
                "doc" => "Unique identifier of the CITI agent records this artist represents",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->datahub_id; },
            ],
        ];

    }

}
