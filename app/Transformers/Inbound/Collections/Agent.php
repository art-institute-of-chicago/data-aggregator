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
            'agent_type_citi_id' => $datum->agent_type_id,
        ];
    }

    protected function getSync(Datum $datum, $test = false)
    {
        return [
            'places' => $this->getSyncPlaces($datum),
        ];
    }

    /**
     * Attach agent places, and what happened to the agent in each place.
     *
     * @return array
     */
    private function getSyncPlaces(Datum $datum)
    {
        return $this->getSyncPivots($datum, 'agent_places', 'place_id', function ($pivot) {
            return [
                $pivot->place_id => [
                    'agent_place_qualifier_citi_id' => $pivot->place_qualifier_id,
                    'is_preferred' => $pivot->is_preferred,
                ],
            ];
        });
    }
}
