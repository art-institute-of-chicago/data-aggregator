<?php

namespace App\Http\Transformers;

use App\Collections\Agent;
use League\Fractal\TransformerAbstract;

class AgentTransformer extends ApiTransformer
{

    public $citiObject = true;
    
    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Agent  $item
     * @return array
     */
    public function transformFields($item)
    {
        return [
            'birth_date' => $item->date_birth,
            'death_date' => $item->date_death,
            'agent_type' => $item->agentType()->getResults() ? $item->agentType()->getResults()->title : '',
            'agent_type_id' => $item->agent_type_citi_id,
        ];
    }
}