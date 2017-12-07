<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

/**
 * Represents a person or organization. In the API, this includes artists, venues, and copyright representatives.
 */
class Agent extends CollectionsModel
{

    use ElasticSearchable;
    use Documentable;

    protected $primaryKey = 'citi_id';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];

    public function agentType()
    {

        return $this->belongsTo('App\Models\Collections\AgentType');

    }

    public function createdArtworks()
    {

        return $this->belongsToMany('App\Models\Collections\Artwork', 'artwork_artist');

    }

    public function copyrightedArtworks()
    {

        return $this->belongsToMany('App\Models\Collections\Artwork', 'artwork_copyright_representative');

    }

    public function exhibitions()
    {

        return $this->belongsToMany('App\Models\Collections\Exhibition');

    }

    public function sites()
    {

        return $this->belongsToMany('App\Models\StaticArchive\Site', 'agent_site', 'agent_citi_id');

    }

    /**
     * Scope a query to only include agents that created an artwork.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeArtists($query)
    {

        return $query->whereHas('createdArtworks');

    }

    /**
     * Scope a query to only include agents that are copyright representatives for an artwork.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCopyrightRepresentatives($query)
    {

        return $query->whereHas('copyrightedArtworks');

    }

    /**
     * Scope a query to only include agents that have hosted an exhibition.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVenues($query)
    {

        return $query->whereHas('exhibitions');

    }

    public function getFillFieldsFrom($source)
    {

        return [
            'birth_date' => $source->date_birth,
            //'birth_place' => ,
            'death_date' => $source->date_death,
            //'death_place' => ,
            //'licensing_restricted' => ,

            // @TODO Artist is not a valid agent type. Artistry is determined by relation.
            //'agent_type_citi_id' => \App\Models\Collections\AgentType::where('title', 'Artist')->first()->citi_id,
        ];

    }

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'birth_date',
                "doc" => "The year this agent was born",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->birth_date; },
            ],
            [
                "name" => 'birth_place',
                "doc" => "Name of the place this agent was born",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->birth_place; },
            ],
            [
                "name" => 'death_date',
                "doc" => "The year this agent died",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->death_date; },
            ],
            [
                "name" => 'death_place',
                "doc" => "Name of the place this agent died",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->death_place; },
            ],
            [
                "name" => 'is_licensing_restricted',
                "doc" => "Whether the use of the images of works by this artist are restricted by licensing",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return (bool) $this->licensing_restricted; },
            ],
            [
                "name" => 'is_artist',
                "doc" => "Whether the agent is an artist. Soley based on whether the agent is listed as an artist for an artwork record.",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return (bool) $this->is_artist; },
            ],
            [
                "name" => 'agent_type',
                "doc" => "Name of the type of agent, e.g., individual, fund, school, organization, corporate body, etc.",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->agentType()->getResults() ? $this->agentType()->getResults()->title : ''; },
            ],
            [
                "name" => 'agent_type_id',
                "doc" => "Unique identifier of the type of agent",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->agent_type_citi_id; },
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

}
