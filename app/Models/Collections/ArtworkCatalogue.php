<?php

namespace App\Models\Collections;

use App\Models\AbstractPivot as BasePivot;

/**
 * Details of a catalogue raisonne that includes a work of art
 */
class ArtworkCatalogue extends BasePivot
{

    protected $primaryKey = 'citi_id';

    protected $casts = [
        'date_start' => 'datetime',
        'date_end' => 'datetime',
        'source_created_at' => 'datetime',
        'source_modified_at' => 'datetime',
        'source_indexed_at' => 'datetime',
        'citi_created_at' => 'datetime',
        'citi_modified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function artwork()
    {

        return $this->belongsTo('App\Models\Collections\Artwork');

    }

    public function catalogue()
    {

        return $this->belongsTo('App\Models\Collections\Catalogue');

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
                "doc" => "Name of the artwork this catalogue raisonne includes",
                "type" => "string",
                "value" => function() { return $this->artwork ? $this->artwork->title : null; },
            ],
            [
                "name" => 'artwork_id',
                "doc" => "Unique identifier of the artwork this catalogue raisonne includes",
                "type" => "number",
                "value" => function() { return $this->artwork_citi_id; },
            ],
            [
                "name" => 'catalogue_title',
                "doc" => "Name of the catalogue raisonne",
                "type" => "string",
                "value" => function() { return $this->catalogue ? $this->catalogue->title : null; },
            ],
            [
                "name" => 'catalogue_id',
                "doc" => "Unique identifier of the catalogue raisonne",
                "type" => "number",
                "value" => function() { return $this->catalogue_citi_id; },
            ],
            [
                "name" => 'number',
                'doc' => "The page or section of the catalogue raisonne that represents this work",
                "type" => "string",
                'value' => function() { return $this->number; },
            ],
            [
                "name" => 'state_edition',
                'doc' => "The edition of the catalogue that includes this work",
                "type" => "string",
                'value' => function() { return $this->state_edition; },
            ],
            [
                "name" => 'is_preferred',
                "doc" => "Whether this catalogue raisonne is the preferred catalogue for this work",
                "type" => "boolean",
                "value" => function() { return (bool) $this->is_preferred; },
            ],
        ];

    }

}
