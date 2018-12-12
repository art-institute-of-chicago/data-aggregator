<?php

namespace App\Models\Dsc;

use App\Models\DscModel;
use App\Models\ElasticSearchable;

/**
 * Represents an overall digital publication.
 */
class Publication extends DscModel
{

    use ElasticSearchable;

    public function sections()
    {

        return $this->hasMany('App\Models\Dsc\Section');

    }

    public function getGenericPageIdAttribute()
    {
        switch ($this->dsc_id) {
        case 7:
            return 9;
            break;
        case 12:
            return 6;
            break;
        case 135446:
            return 12;
            break;
        case 141096:
            return 7;
            break;
        case 135466:
            return 11;
            break;
        case 406:
            return 13;
            break;
        case 445:
            return 8;
            break;
        case 480:
            return 5;
            break;
        case 226:
            return 10;
            break;
        case 140019:
            return 4;
            break;
        }
    }

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'web_url',
                "doc" => "URL to the publication",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->web_url; },
            ],
            [
                "name" => 'site',
                "doc" => "Which site in our multi-site Drupal installation owns this publication",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->site; },
            ],
            [
                "name" => 'alias',
                "doc" => "Used by Drupal in lieu of the id to generate pretty paths",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->alias; },
            ],
            [
                "name" => 'section_ids',
                "doc" => "Unique identifiers of the sections of this publication",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->sections->pluck('dsc_id'); },
            ],
        ];

    }

}
