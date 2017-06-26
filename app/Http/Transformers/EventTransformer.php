<?php

namespace App\Http\Transformers;

use App\Membership\Event;

class EventTransformer extends ApiTransformer
{

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Membership\Event  $item
     * @return array
     */
    public function transformFields($item)
    {

        return [
            'start' => $item->start->toDateTimeString(),
            'end' => $item->end->toDateTimeString(),
            'type' => $item->type,
            'on_sale' => $item->on_sale->toDateTimeString(),
            'off_sale' => $item->off_sale->toDateTimeString(),
            'resource' => $item->resource,
            'user_event_number' => $item->user_event_number,
            'available' => $item->available,
            'total_capacity' => $item->total_capacity,
            'status' => $item->status,
            'rs_event_seat_map_id' => $item->rs_event_seat_map_id,
            'has_roster' => (bool) $item->has_roster,
            'private_event' => (bool) $item->private_event,
            'has_holds' => (bool) $item->has_holds,
        ];

    }

}