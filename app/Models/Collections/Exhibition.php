<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

/**
 * An organized presentation and display of a selection of artworks.
 */
class Exhibition extends CollectionsModel
{

    use ElasticSearchable;
    use Documentable;

    protected $primaryKey = 'citi_id';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];

    public function artworks()
    {

        return $this->belongsToMany('App\Models\Collections\Artwork');

    }

    public function venues()
    {

        return $this->belongsToMany('App\Models\Collections\CorporateBody', 'agent_exhibition', 'exhibition_citi_id', 'agent_citi_id');

    }

    public function department()
    {

        return $this->belongsTo('App\Models\Collections\Department');

    }

    public function gallery()
    {

        return $this->belongsTo('App\Models\Collections\Gallery');

    }

    public function seedArtworks()
    {

        $artworkIds = \App\Models\Collections\Artwork::all()->pluck('citi_id')->all();

        for ($i = 0; $i < rand(2,8); $i++) {

            $artworkId = $artworkIds[array_rand($artworkIds)];

            $this->artworks()->attach($artworkId);

        }

        return $this;

    }

    public function seedVenues()
    {

        $agentIds = \App\Models\Collections\CorporateBody::all()->pluck('citi_id')->all();

        for ($i = 0; $i < rand(1,3); $i++) {

            $agentId = $agentIds[array_rand($agentIds)];

            $this->venues()->attach($agentId);

        }

        return $this;

    }


    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            'description' => [
                "doc" => "Explanation of what this exhibition is",
                "type" => "string",
                "value" => function() { return $this->description; },
            ],
            'type' => [
                "doc" => "The type of exhibition. In particular this notes whether the exhibition was only displayed at the Art Institute or whether it traveled to other venues, or whether it was",
                "type" => "string",
                "value" => function() { return $this->type; },
            ],
            'department' => [
                "doc" => "The name of the department that primarily organized the exhibition",
                "type" => "string",
                "value" => function() { return $this->department()->getResults() ? $this->department()->getResults()->title : ''; },
            ],
            'department_id' => [
                "doc" => "Unique identifier of the department that primarily organized the exhibition",
                "type" => "number",
                "value" => function() { return $this->department_citi_id; },
            ],
            'gallery' => [
                "doc" => "The name of the gallery that mainly housed the exhibition",
                "type" => "string",
                "value" => function() { return $this->gallery()->getResults() ? $this->gallery()->getResults()->title : ''; },
            ],
            'gallery_id' => [
                "doc" => "Unique identifier of the gallery that mainly housed the exhibition",
                "type" => "number",
                "value" => function() { return $this->gallery_citi_id; },
            ],
            'dates' => [
                "doc" => "A readable string of when the exhibition took place",
                "type" => "string",
                "value" => function() { return $this->exhibition_dates; },
            ],
            'is_active' => [
                "doc" => "Whether the exhibition is active",
                "type" => "boolean",
                "value" => function() { return (bool) $this->active; },
            ],
            'artwork_ids' => [
                "doc" => "Unique identifiers of the artworks that were part of the exhibition",
                "type" => "array",
                "value" => function() { return $this->artworks->pluck('citi_id')->all(); },
            ],
            'venue_ids' => [
                "doc" => "Unique identifiers of the venue agent records representing who hosted the exhibition",
                "type" => "array",
                "value" => function() { return $this->venues->pluck('citi_id')->all(); },
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
            'venue_titles' => $this->venues->pluck('title')->all(),

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
                'type' => [
                    'type' => 'keyword',
                ],
                'department' => [
                    'type' => 'text',
                ],
                'department_id' => [
                    'type' => 'integer',
                ],
                'gallery' => [
                    'type' => 'text',
                ],
                'gallery_id' => [
                    'type' => 'integer',
                ],
                'dates' => [
                    'type' => 'text',
                ],
                'is_active' => [
                    'type' => 'boolean',
                ],
                'artwork_id' => [
                    'type' => 'integer',
                ],
                'artwork_ids' => [
                    'type' => 'integer',
                ],
                'artwork_titles' => [
                    'type' => 'text',
                ],
                'venue_ids' => [
                    'type' => 'integer',
                ],
                'venue_titles' => [
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

        return "903287";

    }

    /**
     * Get the subresources for the resource.
     *
     * @return array
     */
    public function subresources()
    {

        return ['artworks', 'venues'];

    }

}
