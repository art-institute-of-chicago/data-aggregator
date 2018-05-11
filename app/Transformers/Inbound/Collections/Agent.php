<?php

namespace App\Transformers\Inbound\Collections;

use App\Models\Collections\AgentPlace;

use App\Transformers\Datum;
use App\Transformers\Inbound\CollectionsTransformer;

class Agent extends CollectionsTransformer
{

    protected function getExtraFields( Datum $datum )
    {

        return [
            'birth_date' => $datum->date_birth,
            'death_date' => $datum->date_death,
            'licensing_restricted' => $datum->is_licensing_restricted,
            'agent_type_citi_id' => $datum->agent_type_id,
        ];

    }

    protected function getSync( Datum $datum )
    {

        return [
            'places' => $this->getSyncPlaces( $datum ),
        ];

    }

    private function getSyncPlaces( Datum $datum )
    {

        return $this->getSyncPivots( $datum, 'agent_places', 'place_id', function( $pivot ) {

            return [
                $pivot->place_id => [
                    'citi_id' => $pivot->citi_id, // TODO: Make this incremental
                    // TODO: Change qualifier to a normalized relation! Not a string.
                    'qualifier' => $pivot->qualifier_id,
                    'is_preferred' => $pivot->is_preferred,
                ]
            ];

        });

    }

}
