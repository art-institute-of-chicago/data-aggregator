<?php

namespace App\Transformers\Inbound\Collections;

use App\Transformers\Datum;
use App\Transformers\Inbound\CollectionsTransformer;

class Agent extends CollectionsTransformer
{
    protected function getExtraFields(Datum $datum)
    {
        return [
            'birth_date' => $datum->date_birth,
            'death_date' => $datum->date_death,
            'agent_type_id' => $datum->agent_type_id,
        ];
    }
}
