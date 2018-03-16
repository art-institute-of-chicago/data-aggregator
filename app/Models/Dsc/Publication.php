<?php

namespace App\Models\Dsc;

use App\Models\DscModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

/**
 * Represents an overall digital publication.
 */
class Publication extends DscModel
{

    use ElasticSearchable;
    use Documentable;

    protected $hasSourceDates = false;

    public function sections()
    {

        return $this->hasMany('App\Models\Dsc\Section');

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


    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "445";

    }

}
