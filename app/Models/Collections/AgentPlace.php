<?php

namespace App\Models\Collections;

use App\Models\Fillable;
use App\Models\Instancable;
use App\Models\Transformable;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * A place that an agent is connected with
 */
class AgentPlace extends Pivot
{

    use Fillable, Instancable, Transformable;

    protected $primaryKey = 'citi_id';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];

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
            'place_citi_id' => $source->place_id,
        ];

    }

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'agent',
                "doc" => "Name of the agent the place is associated with",
                "type" => "string",
                "value" => function() { return $this->agent ? $this->agent->title : null; },
            ],
            [
                "name" => 'agent_id',
                "doc" => "Unique identifier of the agent the place is associated with",
                "type" => "number",
                "value" => function() { return $this->agent_citi_id; },
            ],
            [
                "name" => 'place',
                "doc" => "Name of the place the agent is associated with",
                "type" => "string",
                "value" => function() { return $this->place ? $this->place->title : null; },
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
