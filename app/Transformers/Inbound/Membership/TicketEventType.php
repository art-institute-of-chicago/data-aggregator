<?php

namespace App\Transformers\Inbound\Membership;

use App\Transformers\Datum;
use App\Transformers\Inbound\MembershipTransformer;

class TicketedEventType extends MembershipTransformer
{

    protected function getIds( Datum $datum )
    {

        return [
            'membership_id' => $datum->event_type_id,
        ];

    }

}
