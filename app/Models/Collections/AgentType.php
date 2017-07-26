<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;

class AgentType extends CollectionsModel
{

    protected $primaryKey = 'citi_id';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];

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

}
