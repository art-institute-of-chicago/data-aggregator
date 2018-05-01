<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;

class ArtworkDate extends CollectionsModel
{

    protected $primaryKey = 'citi_id';

    protected $casts = [
        'preferred' => 'boolean',
        'date_earliest' => 'date',
        'date_latest' => 'date',
    ];

    public function artwork()
    {

        return $this->belongsTo('App\Models\Collections\Artwork');

    }

    public function qualifier()
    {

        return $this->belongsTo('App\Models\Collections\ArtworkDateQualifier', 'artwork_date_qualifier_citi_id');

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
                "name" => 'date_earliest',
                "doc" => "Start or earliest possible date, if estimated",
                "type" => "string",
                "value" => function() { return $this->date_earliest ? $this->date_earliest->toIso8601String() : null; },
            ],
            [
                "name" => 'date_latest',
                "doc" => "End or latest possible date, if estimated",
                "type" => "number",
                "value" => function() { return $this->date_latest ? $this->date_latest->toIso8601String() : null; },
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

    /**
     * We are overriding this so that we can skip showing search, id, title, and date fields.
     *
     * @param boolean  withTitles  Ignore this – it's only here for compatibility
     * @return array
     */
    public function transform($withTitles = false)
    {

        // In the original method, this calls `transformMapping`
        $fields = $this->transformMappingInternal();

        $out = [];

        foreach ($fields as $field)
        {

            $out[ $field["name"] ] = call_user_func( $field["value"] );

        }

        return $out;

    }

}
