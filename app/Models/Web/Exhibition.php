<?php

namespace App\Models\Web;

use App\Models\WebModel;
use App\Models\Documentable;
use App\Models\ElasticSearchable;

/**
 * An enhanced exhibition on the website
 */
class Exhibition extends WebModel
{

    public $table = 'web_exhibitions';

    protected $apiCtrl = 'WebExhibitionsController';

    protected $casts = [
        'published' => 'boolean',
    ];

    public function exhibition()
    {

        return $this->belongsTo('App\Models\Collections\Exhibition', 'datahub_id');

    }

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'header_copy',
                "doc" => "The text at the top of the exhibition page",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->header_copy; },
            ],
            [
                "name" => 'exhibition_id',
                "doc" => "Identifer of the CITI exhibtion this website exhibition is tied to",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->exhibition ? $this->exhibition->citi_id : NULL; },
            ],
            [
                "name" => 'type',
                "doc" => "Number indicating the type of closure",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->type; },
            ],
            [
                "name" => 'exhibition_message',
                "doc" => "The sub copy on the exhibition page",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->exhibition_message; },
            ],
            [
                "name" => 'sponsors_sub_copy',
                "doc" => "The sponsors copy on the exhibition",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->sponsors_sub_copy; },
            ],
            [
                "name" => 'cms_exhibition_type',
                "doc" => "Number indicating the type of exhibition",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->cms_exhibition_type; },
            ],
            [
                "name" => 'published',
                "doc" => "Whether the location is published on the website",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->published; },
            ],
        ];

    }

}
