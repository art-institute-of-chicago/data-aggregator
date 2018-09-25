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

    protected $touches = ['exhibition'];

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
                "name" => 'is_featured', // TODO: Dedupe w/ is_boosted?
                "doc" => "Is this exhibition currently featured on our website?",
                "type" => "boolean",
                "elasticsearch_type" => 'boolean',
                "value" => function() { return (bool) $this->is_featured ?? false; },
            ],
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
                "name" => 'list_description',
                "doc" => "Short description to be used for exhibition listings",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->list_description; },
            ],
            [
                "name" => 'exhibition_message',
                "doc" => "Pricing or attendance information",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->exhibition_message; },
            ],
            [
                "name" => 'published', // TODO: Rename to is_published!
                "doc" => "Whether the location is published on the website",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->is_published; },
            ],
        ];

    }

}
