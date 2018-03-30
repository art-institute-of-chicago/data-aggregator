<?php

namespace App\Models\Collections;

use App\Models\AbstractPivot as BasePivot;

class ArtworkArtistPivot extends BasePivot
{

    protected $table = 'artwork_artist';

    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];

    protected $casts = [
        'preferred' => 'boolean',
    ];

    public function artist()
    {

        return $this->belongsTo('App\Models\Collections\Agent', 'agent_citi_id');

    }

    public function artwork()
    {

        return $this->belongsTo('App\Models\Collections\Artwork');

    }

    public function role()
    {

        return $this->belongsTo('App\Models\Collections\AgentRole', 'agent_role_citi_id');

    }

    public function getUpdatedAtColumn()
    {

        return 'updated_at';

    }

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'artwork_title',
                "doc" => "Name of the work this artist made",
                "type" => "string",
                "value" => function() { return $this->artwork->title ?? null; },
            ],
            [
                "name" => 'artwork_id',
                "doc" => "Unique identifier of the work this artist made",
                "type" => "number",
                "value" => function() { return $this->artwork->citi_id ?? null; },
            ],
            [
                "name" => 'artist_title',
                "doc" => "Name of the artist",
                "type" => "string",
                "value" => function() { return $this->artist->title ?? null; },
            ],
            [
                "name" => 'artist_id',
                "doc" => "Unique identifier of the artist",
                "type" => "number",
                "value" => function() { return $this->artist->citi_id ?? null; },
            ],
            [
                "name" => 'role_title',
                "doc" => "Name of the role this artist played in the making of the work",
                "type" => "string",
                "value" => function() { return $this->role->title ?? null; },
            ],
            [
                "name" => 'role_id',
                "doc" => "Unique identifier of the role this artist played in the making of the work",
                "type" => "number",
                "value" => function() { return $this->role->citi_id ?? null; },
            ],
            [
                "name" => 'preferred',
                'doc' => "Whether this is a preferred artist",
                "type" => "boolean",
                'value' => function() { return (bool) $this->preferred; },
            ],
        ];

    }

}
