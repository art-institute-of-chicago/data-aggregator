<?php

namespace App\Models\Web;

use App\Models\WebModel;
use App\Models\Documentable;
use App\Models\ElasticSearchable;

/**
 * Page on the website
 */
class Page extends WebModel
{

    protected $hasSourceDates = false;

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'type',
                "doc" => "Number indicating the type of page this record represents",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->type; },
            ],
            [
                "name" => 'home_intro',
                "doc" => "The text in the header of the home page",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->home_intro; },
            ],
            [
                "name" => 'exhibition_intro',
                "doc" => "The text in the header of the exhibition page",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->exhibition_intro; },
            ],
            [
                "name" => 'collections_intro',
                "doc" => "The text in the header of the collections page",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->art_intro; },
            ],
            [
                "name" => 'visit_intro',
                "doc" => "The text in the header of the visit page",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->visit_intro; },
            ],
        ];

    }

}
