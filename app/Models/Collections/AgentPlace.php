<?php

namespace App\Models\Collections;

use App\Models\AbstractPivot as BasePivot;

/**
 * A place that an agent is connected with
 */
class AgentPlace extends BasePivot
{

    protected $primaryKey = 'citi_id';

    public function agent()
    {

        return $this->belongsTo('App\Models\Collections\Agent');

    }

    public function place()
    {

        return $this->belongsTo('App\Models\Collections\Place');

    }

    public function getCreatedAtColumn()
    {

        return 'created_at';

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
                "name" => 'agent_title',
                "doc" => "Name of the agent the place is associated with",
                "type" => "string",
                "value" => function() { return $this->agent->title ?? null; },
            ],
            [
                "name" => 'agent_id',
                "doc" => "Unique identifier of the agent the place is associated with",
                "type" => "number",
                "value" => function() { return $this->agent_citi_id; },
            ],
            [
                "name" => 'place_title',
                "doc" => "Name of the place the agent is associated with",
                "type" => "string",
                "value" => function() { return $this->place->title ?? null; },
            ],
            [
                "name" => 'place_id',
                "doc" => "Unique identifier of the place the agent is associated with",
                "type" => "number",
                "value" => function() { return $this->place_citi_id; },
            ],
            [
                "name" => 'qualifier',
                'doc' => "Description of how the agent is associated with the place. For example, born in, died in, worked in, lived in, etc.",
                "type" => "string",
                'value' => function() { return $this->qualifier; },
            ],
            [
                "name" => 'is_preferred',
                "doc" => "Whether this place is preferred place to display for this agent",
                "type" => "boolean",
                "value" => function() { return (bool) $this->is_host; },
            ],
        ];

    }

}
