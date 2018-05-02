<?php

namespace App\Models\Collections;

use App\Models\AbstractPivot as BasePivot;

class ArtworkTerm extends BasePivot
{

    public $incrementing = true;

    public function term()
    {

        return $this->belongsTo('App\Models\Collections\Term');

    }

    public function artwork()
    {

        return $this->belongsTo('App\Models\Collections\Artwork');

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
                "doc" => "Name of the work this term is for",
                "type" => "string",
                "value" => function() { return $this->artwork ? $this->artwork->title : null; },
            ],
            [
                "name" => 'artwork_id',
                "doc" => "Unique identifier of the work this term is for",
                "type" => "number",
                "value" => function() { return $this->artwork_citi_id; },
            ],
            [
                "name" => 'term_title',
                "doc" => "Name of the term",
                "type" => "string",
                "value" => function() { return $this->term ? $this->term->title : null; },
            ],
            [
                "name" => 'term_id',
                "doc" => "Unique identifier of the term",
                "type" => "number",
                "value" => function() { return $this->term_citi_id; },
            ],
            [
                "name" => 'preferred',
                'doc' => "Whether this is a preferred term",
                "type" => "boolean",
                'value' => function() { return (bool) $this->preferred; },
            ],
        ];

    }

}
