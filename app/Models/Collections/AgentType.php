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

        // AgentType has no non-id, non-date fields
        return [];

    }

}
