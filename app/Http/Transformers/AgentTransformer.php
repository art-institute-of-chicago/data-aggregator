<?php

namespace App\Http\Transformers;

use App\Models\Collections\Agent;

class AgentTransformer extends CollectionsTransformer
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['places'];


    /**
     * Include places.
     *
     * @param  \App\Models\Collections\Agent  $agent
     * @return League\Fractal\ItemResource
     */
    public function includePlaces(Agent $agent)
    {
        return $this->collection($agent->places()->getResults(), new CollectionsTransformer, false);
    }

}
