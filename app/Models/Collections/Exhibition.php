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

    /**
     * @TODO Differentiate between venues and artists represented in the exhibition.
     */
    public function venues()
    {

        return $this->belongsToMany('App\Models\Collections\Agent', 'agent_exhibition', 'exhibition_citi_id', 'agent_citi_id');

    }

    public function department()
    {

        return $this->belongsTo('App\Models\Collections\Department');

    }

    public function gallery()
    {

        return $this->belongsTo('App\Models\Collections\Gallery');

    }

    public function sites()
    {

        return $this->belongsToMany('App\Models\StaticArchive\Site');

    }


    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'description',
                "doc" => "Explanation of what this exhibition is",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->description; },
            ],
            [
                "name" => 'type',
                "doc" => "The type of exhibition. In particular this notes whether the exhibition was only displayed at the Art Institute or whether it traveled to other venues, or whether it was",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->type; },
            ],
            [
                "name" => 'department',
                "doc" => "The name of the department that primarily organized the exhibition",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->department()->getResults() ? $this->department()->getResults()->title : ''; },
            ],
            [
                "name" => 'department_id',
                "doc" => "Unique identifier of the department that primarily organized the exhibition",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->department ? $this->department->citi_id : null; },
            ],
            [
                "name" => 'gallery',
                "doc" => "The name of the gallery that mainly housed the exhibition",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->gallery()->getResults() ? $this->gallery()->getResults()->title : ''; },
            ],
            [
                "name" => 'gallery_id',
                "doc" => "Unique identifier of the gallery that mainly housed the exhibition",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->gallery ? $this->gallery->citi_id : null; },
            ],
            [
                "name" => 'dates',
                "doc" => "A readable string of when the exhibition took place",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->exhibition_dates; },
            ],
            [
                "name" => 'is_active',
                "doc" => "Whether the exhibition is active",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return (bool) $this->active; },
            ],
            [
                "name" => 'artwork_ids',
                "doc" => "Unique identifiers of the artworks that were part of the exhibition",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->artworks->pluck('citi_id')->all(); },
            ],
            [
                "name" => 'venue_ids',
                "doc" => "Unique identifiers of the venue agent records representing who hosted the exhibition",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->venues->pluck('citi_id')->all(); },
            ],
            [
                "name" => 'site_ids',
                "doc" => "Unique identifiers of the microsites this exhibition is a part of",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->sites->pluck('site_id')->all(); },
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

            [
                "name" => 'artwork_titles',
                "doc" => "Names of the artworks that were part of the exhibition",
                "type" => "array",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->artworks->pluck('title')->all(); },
            ],
            [
                "name" => 'venue_titles',
                "doc" => "Names of the venue agent records representing who hosted the exhibition",
                "type" => "array",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->venues->pluck('title')->all(); },
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

        return "1302";

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
