<?php

namespace App\Http\Transformers;

use App\Collections\Agent;
use League\Fractal\TransformerAbstract;

class AgentTransformer extends TransformerAbstract
{

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Agent  $item
     * @return array
     */
    public function transform(Agent $item)
    {
        return [
            'id' => $item->citi_id,
            'title' => $item->title,
            'birth_date' => $item->date_birth,
            'death_date' => $item->date_death,
            'agent_type' => $item->agentType()->getResults() ? $item->agentType()->getResults()->title : '',
            'agent_type_id' => $item->agent_type_citi_id,
            'last_updated_lpm_fedora' => $item->api_modified_at->toDateTimeString(),
            'last_updated_lpm_solr' => $item->api_indexed_at->toDateTimeString(),
            'last_updated' => $item->updated_at->toDateTimeString(),
        ];
    }
}