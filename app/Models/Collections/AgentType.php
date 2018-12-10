<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\Documentable;

/**
 * A kind of agent, e.g. Individual, Couple, School, Estate, Culture.
 */
class AgentType extends CollectionsModel
{

    use Documentable;

    protected $primaryKey = 'citi_id';

    protected $fakeIdsStartAt = 99900;

    /**
     * Whether this resource has a `/search` endpoint
     *
     * @return boolean
     */
    public function hasSearchEndpoint()
    {

        return false;

    }

}
