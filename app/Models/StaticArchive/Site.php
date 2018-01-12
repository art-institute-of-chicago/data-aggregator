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
            [
                "name" => 'description',
                "doc" => "Explanation of what this site is",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->description; },
            ],
            [
                "name" => 'web_url',
                "doc" => "URL to this site",
                "type" => "url",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->web_url; },
            ],
            [
                "name" => 'exhibition_ids',
                "doc" => "Unique identifier of the exhibitions this site is associated with",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->exhibitions->pluck('citi_id')->all(); },
            ],
            [
                "name" => 'artist_ids',
                "doc" => "Unique identifiers of the artists this site is associated with",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->agents->pluck('citi_id')->all(); },
            ],
            [
                "name" => 'artwork_ids',
                "doc" => "Unique identifiers of the artworks this site is associated with",
                "type" => "array",
                'elasticsearch_type' => 'integer',
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

            [
                "name" => 'artwork_titles',
                "doc" => "Names of the artworks this site is associated with",
                "type" => "array",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->artworks->pluck('title')->all(); },
            ],
            [
                "name" => 'exhibition_titles',
                "doc" => "Names of the exhibitions this site is associated with",
                "type" => "array",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->exhibitions->pluck('title')->all(); },
            ],
            [
                "name" => 'artist_titles',
                "doc" => "Names of the artists this site is associated with",
                "type" => "array",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->agents->pluck('title')->all(); },
            ],

        ];

    }

    public function getExtraFillFieldsFrom($source)
    {

        return [
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
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "1";

    }

}
