<?php

namespace App\Transformers\Inbound\Membership;

use App\Transformers\Datum;
use App\Transformers\Inbound\MembershipTransformer;

class TicketedEvent extends MembershipTransformer
{

    protected function getExtraFields( Datum $datum )
    {

        return [
            'event_type_id' => $datum->type_id,
            'start_at' => $datum->date('start_at'),
            'end_at' => $datum->date('end_at'),
        ];

    }

}
