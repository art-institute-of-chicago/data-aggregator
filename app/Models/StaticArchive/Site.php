<?php

namespace App\Models\StaticArchive;

use App\Models\BaseModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

/**
 * An archived static microsite.
 */
class Site extends BaseModel
{

    use ElasticSearchable;
    use Documentable;

    protected $primaryKey = 'site_id';
    protected $dates = ['source_created_at', 'source_modified_at'];

    public function exhibition()
    {

        return $this->belongsTo('App\Models\Collections\Exhibition');

    }

    public function artworks()
    {

        return $this->belongsToMany('App\Models\Collections\Artwork');

    }


    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            'description' => [
                "doc" => "Explanation of what this site is",
                "type" => "string",
                "value" => function() { return $this->description; },
            ],
            'link' => [
                "doc" => "URL to this site",
                "type" => "url",
                "value" => function() { return $this->link; },
            ],
            'exhibition' => [
                "doc" => "The name of the exhibition this site is associated with",
                "type" => "string",
                "value" => function() { return $this->exhibition ? $this->exhibition->title : ""; },
            ],
            'exhibition_id' => [
                "doc" => "Unique identifier of the exhibition this site is associated with",
                "type" => "number",
                "value" => function() { return $this->exhibition ? $this->exhibition->citi_id : null; },
            ],
            'artwork_ids' => [
                "doc" => "Unique identifiers of the artworks this site is associated with",
                "type" => "array",
                "value" => function() { return $this->artworks->pluck('citi_id')->all(); },
            ],
        ];

    }


    /**
     * Turn the titles for related models into a generic array
     *
     * @return array
     */
    protected function transformTitles()
    {

        return [

            'artwork_titles' => $this->artworks->pluck('title')->all(),

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
                'link' => [
                    'type' => 'keyword',
                ],
                'exhibition' => [
                    'type' => 'text',
                ],
                'exhibition_id' => [
                    'type' => 'integer',
                ],
                'artwork_ids' => [
                    'type' => 'integer',
                ],
                'artwork_titles' => [
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

        return "2842";

    }

}
