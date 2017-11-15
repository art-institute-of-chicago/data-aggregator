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
    protected $fakeIdsStartAt = 9990000;
    protected $hasSourceDates = false;

    protected function fillIdsFrom($source)
    {

        $this->site_id = $source->id;

        return $this;

    }

    public function exhibitions()
    {

        return $this->belongsToMany('App\Models\Collections\Exhibition');

    }

    public function agents()
    {

        return $this->belongsToMany('App\Models\Collections\Agent');

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
            'exhibition_ids' => [
                "doc" => "Unique identifier of the exhibitions this site is associated with",
                "type" => "array",
                "value" => function() { return $this->exhibitions->pluck('citi_id')->all(); },
            ],
            'artist_ids' => [
                "doc" => "Unique identifiers of the artists this site is associated with",
                "type" => "array",
                "value" => function() { return $this->agents->pluck('citi_id')->all(); },
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
            'exhibition_titles' => $this->exhibitions->pluck('title')->all(),
            'artist_titles' => $this->agents->pluck('title')->all(),

        ];

    }

    public function getFillFieldsFrom($source)
    {

        return [
            'site_id' => $source->id,
            'description' => $source->description,
            'web_url' => $source->link,
        ];

    }

    public function attachFrom($source)
    {

        if ($source->exhibition_ids)
        {

            $this->exhibitions()->sync($source->exhibition_ids, false);

        }

        if ($source->agent_ids)
        {

            $this->agents()->sync($source->agent_ids, false);

        }

        if ($source->artwork_ids)
        {

            $this->artworks()->sync($source->artwork_ids, false);

        }

        return $this;

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
                'exhibition_ids' => [
                    'type' => 'integer',
                ],
                'exhibition_titles' => [
                    'type' => 'text',
                ],
                'artist_ids' => [
                    'type' => 'integer',
                ],
                'artist_titles' => [
                    'type' => 'text',
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

        return "1";

    }

}
