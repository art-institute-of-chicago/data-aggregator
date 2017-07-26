<?php

namespace App\Models\Membership;

use App\Models\MembershipModel;
use App\Models\SolrSearchable;

class Event extends MembershipModel
{

    use SolrSearchable;

    protected $dates = ['start', 'end', 'on_sale', 'off_sale', 'source_created_at', 'source_modified_at', 'source_indexed_at'];


    /**
     * Turn this model object into a generic array.
     *
     * @param boolean  $withTitles
     * @return array
     */
    public function transformFields()
    {

        return [
            'start' => $this->start->toDateTimeString(),
            'end' => $this->end->toDateTimeString(),
            'type' => $this->type,
            'on_sale' => $this->on_sale->toDateTimeString(),
            'off_sale' => $this->off_sale->toDateTimeString(),
            'resource' => $this->resource,
            'user_event_number' => $this->user_event_number,
            'available' => $this->available,
            'total_capacity' => $this->total_capacity,
            'status' => $this->status,
            'rs_event_seat_map_id' => $this->rs_event_seat_map_id,
            'has_roster' => (bool) $this->has_roster,
            'is_private_event' => (bool) $this->private_event,
            'has_holds' => (bool) $this->has_holds,
        ];

    }

}
