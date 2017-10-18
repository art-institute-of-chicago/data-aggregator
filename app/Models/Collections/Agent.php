<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

/**
 * Represents a person or organization. In the API, this includes artists, copyright representives and corporate bodies.
 */
class Agent extends CollectionsModel
{

    use ElasticSearchable;
    use Documentable;

    protected $primaryKey = 'citi_id';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];

    public function artworks()
    {
        return $this->hasMany('App\Models\Collections\Artwork');
    }

    public function agentType()
    {

        return $this->belongsTo('App\Models\Collections\AgentType');

    }

    public function getFillFieldsFrom($source)
    {

        return [
            'birth_date' => $source->date_birth,
            //'birth_place' => ,
            'death_date' => $source->date_death,
            //'death_place' => ,
            //'licensing_restricted' => ,
            'agent_type_citi_id' => \App\Models\Collections\AgentType::where('title', 'Artist')->first()->citi_id,
        ];

    }

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            'birth_date' => [
                "doc" => "The year this agent was born",
                "value" => function() { return $this->birth_date; },
            ],
            'birth_place' => [
                "doc" => "Name of the place this agent was born",
                "value" => function() { return $this->birth_place; },
            ],
            'death_date' => [
                "doc" => "The year this agent died",
                "value" => function() { return $this->death_date; },
            ],
            'death_place' => [
                "doc" => "Name of the place this agent died",
                "value" => function() { return $this->death_place; },
            ],
            'is_licensing_restricted' => [
                "doc" => "Whether the use of the images of works by this artist are resticted by licensing",
                "value" => function() { return (bool) $this->licensing_restricted; },
            ],
            'agent_type' => [
                "doc" => "Name of the type of agent, e.g., 'Artist', 'Copyright Representative', or 'Corporate Body'",
                "value" => function() { return $this->agentType()->getResults() ? $this->agentType()->getResults()->title : ''; },
            ],
            'agent_type_id' => [
                "doc" => "Unique identifier of the type of agent",
                "value" => function() { return $this->agent_type_citi_id; },
            ],
        ];

    }


    /**
     * Generate model-specific fields for an array representing the schema for this object.
     *
     * @return array
     */
    public function elasticsearchMappingFields()
    {

        return
            [
                'birth_date' => [
                    'type' => 'integer',
                ],
                'birth_place' => [
                    'type' => 'text',
                ],
                'death_date' => [
                    'type' => 'integer',
                ],
                'death_place' => [
                    'type' => 'text',
                ],
                'is_licensing_restricted' => [
                    'type' => 'boolean',
                ],
                'agent_type' => [
                    'type' => 'text',
                ],
                'agent_type_id' => [
                    'type' => 'integer',
                ],
            ];

    }

}
