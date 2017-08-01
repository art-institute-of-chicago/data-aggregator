<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;

class Agent extends CollectionsModel
{

    use ElasticSearchable;

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
     * Turn this model object into a generic array.
     *
     * @return array
     */
    public function transformFields()
    {

        return [
            'birth_date' => $this->birth_date,
            'birth_place' => $this->birth_place,
            'death_date' => $this->death_date,
            'death_place' => $this->death_place,
            'is_licensing_restricted' => (bool) $this->licensing_restricted,
            'agent_type' => $this->agentType()->getResults() ? $this->agentType()->getResults()->title : '',
            'agent_type_id' => $this->agent_type_citi_id,
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
