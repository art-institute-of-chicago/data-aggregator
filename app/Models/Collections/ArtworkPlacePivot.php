<?php

namespace App\Models\Collections;

use App\Models\AbstractPivot as BasePivot;

class ArtworkPlacePivot extends BasePivot
{

    protected $table = 'artwork_place';

    protected $casts = [
        'preferred' => 'boolean',
    ];

    public function artwork()
    {

        return $this->belongsTo('App\Models\Collections\Artwork');

    }

    public function place()
    {

        return $this->belongsTo('App\Models\Collections\Place');

    }

    public function qualifier()
    {

        return $this->belongsTo('App\Models\Collections\ArtworkPlaceQualifier', 'artwork_place_qualifier_citi_id');

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
                "doc" => "Name of the work associated with this place",
                "type" => "string",
                "value" => function() { return $this->artwork->title ?? null; },
            ],
            [
                "name" => 'artwork_id',
                "doc" => "Unique identifier of the work associated with this place",
                "type" => "number",
                "value" => function() { return $this->artwork->citi_id ?? null; },
            ],
            [
                "name" => 'place_title',
                "doc" => "Name of the place associated with this work",
                "type" => "string",
                "value" => function() { return $this->place->title ?? null; },
            ],
            [
                "name" => 'place_id',
                "doc" => "Unique identifier of the place associated with this work",
                "type" => "number",
                "value" => function() { return $this->place->citi_id ?? null; },
            ],
            [
                "name" => 'qualifier_title',
                "doc" => "Name of the qualifier indicating what happened to the work here",
                "type" => "string",
                "value" => function() { return $this->qualifier->title ?? null; },
            ],
            [
                "name" => 'qualifier_id',
                "doc" => "Unique identifier of the qualifier indicating what happened to the work here",
                "type" => "number",
                "value" => function() { return $this->qualifier->citi_id ?? null; },
            ],
            [
                "name" => 'preferred',
                'doc' => "Whether this is the preferred place to represent this work",
                "type" => "boolean",
                'value' => function() { return (bool) $this->preferred; },
            ],
        ];

    }

}
