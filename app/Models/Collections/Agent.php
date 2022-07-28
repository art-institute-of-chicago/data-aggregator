<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;

/**
 * Represents a person or organization. In the API, this includes artists.
 */
class Agent extends CollectionsModel
{
    use ElasticSearchable;

    protected $casts = [
        'alt_titles' => 'array',
    ];

    protected $touches = [
        'createdArtworks',
    ];

    public function agentType()
    {
        return $this->belongsTo('App\Models\Collections\AgentType');
    }

    public function webArtist()
    {
        return $this->belongsTo('App\Models\Web\Artist', 'id', 'datahub_id');
    }

    public function createdArtworks()
    {
        return $this->belongsToMany('App\Models\Collections\Artwork', 'artwork_artist')->artworks();
    }

    public function createdArtworkIds()
    {
        return $this->belongsToMany('App\Models\Collections\Artwork', 'artwork_artist')->pluck('artwork_id');
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
     * Scope a search to only include agents that created an artwork.
     *
     * @return array
     */
    public static function searchScopeArtists()
    {
        return [
            'exists' => [
                'field' => 'artwork_ids',
            ],
        ];
    }
}
