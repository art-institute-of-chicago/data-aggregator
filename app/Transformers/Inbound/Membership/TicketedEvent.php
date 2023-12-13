<?php

namespace App\Transformers\Inbound\Membership;

use Carbon\Carbon;
use App\Transformers\Datum;
use App\Transformers\Inbound\MembershipTransformer;

class TicketedEvent extends MembershipTransformer
{
    protected function getExtraFields(Datum $datum)
    {
        return [
            'event_type_id' => $datum->type_id,
            'start_at' => $this->getDateTime($datum->start_at),
            'end_at' => $this->getDateTime($datum->end_at),
            'on_sale_at' => $this->getDateTime($datum->on_sale_at),
            'off_sale_at' => $this->getDateTime($datum->off_sale_at),
        ];
    }

    // TODO: Abstract this to Datum?
    private function getDateTime(string $value = null)
    {
        return $value ? new Carbon($value) : null;
    }
}
