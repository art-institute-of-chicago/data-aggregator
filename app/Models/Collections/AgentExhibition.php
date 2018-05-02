<?php

namespace App\Models\Collections;

use App\Models\AbstractPivot as BasePivot;

/**
 * A venue in which an exhibition took place
 */
class AgentExhibition extends BasePivot
{

    protected $primaryKey = 'citi_id';

    public function getDates()
    {

        return array_merge( parent::getDates(), [
            'date_start',
            'date_end',
        ]);

    }

    public function agent()
    {

        return $this->belongsTo('App\Models\Collections\Agent');

    }

    public function exhibition()
    {

        return $this->belongsTo('App\Models\Collections\Exhibition');

    }

    public function getUpdatedAtColumn()
    {

        return 'updated_at';

    }

    /**
     * Fill in this model's identifiers from source data.
     * Meant to be overridden, especially by CollectionsModel, etc.
     *
     * @param  object  $source
     * @return $this
     */
    protected function fillIdsFrom($source)
    {

        $this->citi_id = $source->citi_id;

        return $this;

    }

    public function getExtraFillFieldsFrom($source)
    {

        return [
            'agent_citi_id' => $source->agent_id,
            'date_start' => $source->start_date ? strtotime($source->start_date) : null,
            'date_end' => $source->end_date ? strtotime($source->end_date) : null,
        ];

    }

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'agent_title',
                "doc" => "Name of the venue in which this exhibition took place",
                "type" => "string",
                "value" => function() { return $this->agent->title ?? null; },
            ],
            [
                "name" => 'agent_id',
                "doc" => "Unique identifier of the venue in which this exhibition took place",
                "type" => "number",
                "value" => function() { return $this->agent_citi_id; },
            ],
            [
                "name" => 'exhibition_title',
                "doc" => "Name of the exhibition",
                "type" => "string",
                "value" => function() { return $this->exhibition->title ?? null; },
            ],
            [
                "name" => 'exhibition_id',
                "doc" => "Unique identifier of the exhibition",
                "type" => "number",
                "value" => function() { return $this->exhibition_citi_id; },
            ],
            [
                "name" => 'date_start',
                'doc' => "Date the exhibition opened at this venue",
                "type" => "ISO 8601 date and time",
                'value' => function() { return $this->date_start ? $this->date_start->toIso8601String() : NULL; },
            ],
            [
                "name" => 'date_end',
                'doc' => "Date the exhibition closed at this venue",
                "type" => "ISO 8601 date and time",
                'value' => function() { return $this->date_end ? $this->date_end->toIso8601String() : NULL; },
            ],
            [
                "name" => 'is_host',
                "doc" => "Whether this venue was the host for this exhibition",
                "type" => "boolean",
                "value" => function() { return (bool) $this->is_host; },
            ],
            [
                "name" => 'is_organizer',
                "doc" => "Whether this venue was the organizer of this exhibition",
                "type" => "boolean",
                "value" => function() { return (bool) $this->is_organizer; },
            ],
        ];

    }

}
