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

    public function getFillFieldsFrom($source)
    {

        return [
            'web_url' => $source->web_url,
            'site' => $source->site,
            'alias' => $source->alias,
            'title' => $source->title,
        ];

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
                "value" => function() { return $this->web_url; },
            ],
            [
                "name" => 'site',
                "doc" => "Which site in our multi-site Drupal installation owns this publication",
                "type" => "string",
                "value" => function() { return $this->site; },
            ],
            [
                "name" => 'alias',
                "doc" => "Used by Drupal in lieu of the id to generate pretty paths",
                "type" => "string",
                "value" => function() { return $this->alias; },
            ],
            [
                "name" => 'title',
                "doc" => "Official title of the publication",
                "type" => "string",
                "value" => function() { return $this->title; },
            ],
            [
                "name" => 'section_ids',
                "doc" => "Unique identifiers of the sections of this publication",
                "type" => "array",
                "value" => function() { return $this->sections->pluck('dsc_id'); },
            ],
        ];

    }


    /**
     * Generate model-specific fields for an array representing the schema for this object.
     *
     * @return array
     */
    public function elasticsearchMappingFields()
    {

        return
            [
                'web_url' => [
                    'type' => 'keyword',
                ],
                'site' => [
                    'type' => 'keyword',
                ],
                'alias' => [
                    'type' => 'keyword',
                ],
                'title' => [
                    'type' => 'text',
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
