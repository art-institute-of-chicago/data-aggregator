<?php

namespace App\Models\Dsc;

use App\Models\DscModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

/**
 * Represents a chapter of publication.
 */
class Section extends DscModel
{

    use ElasticSearchable;
    use Documentable;

    public function publication()
    {

        return $this->belongsTo('App\Models\Dsc\Publication');

    }


    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            'content' => [
                "doc" => "The text of this section",
                "value" => function() { return $this->content; },
            ],
            'weight' => [
                "doc" => "Number representing this section's sort order",
                "value" => function() { return $this->weight; },
            ],
            'depth' => [
                "doc" => "Number representing how deep in the navigation heirarchy this section resides",
                "value" => function() { return $this->depth; },
            ],
            'publication' => [
                "doc" => "Name of the publication this section belongs to",
                "value" => function() { return $this->publication ? $this->publication->title : ''; },
            ],
            'publication_id' => [
                "doc" => "Unique identifier of the publication this section belongs to",
                "value" => function() { return $this->publication_dsc_id; },
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
                'content' => [
                    'type' => 'text',
                ],
                'weight' => [
                    'type' => 'integer',
                ],
                'depth' => [
                    'type' => 'integer',
                ],
                'publication' => [
                    'type' => 'text',
                ],
                'publication_id' => [
                    'type' => 'integer',
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

        return "59";

    }

}
