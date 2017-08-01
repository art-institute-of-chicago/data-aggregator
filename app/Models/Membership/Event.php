<?php

namespace App\Models\Membership;

use App\Models\MembershipModel;
use App\Models\ElasticSearchable;

class Event extends MembershipModel
{

    use ElasticSearchable;

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


    /**
     * Generate model-specific fields for an array representing the schema for this object.
     *
     * @return array
     */
    public function elasticsearchMappingFields()
    {

        return
            [
                'start' => [
                    'type' => 'date',
                ],
                'end' => [
                    'type' => 'date',
                ],
                'type' => [
                    'type' => 'keyword',
                ],
                'on_sale' => [
                    'type' => 'date',
                ],
                'off_sale' => [
                    'type' => 'date',
                ],
                'resource' => [
                    'type' => 'integer',
                ],
                'user_event_number' => [
                    'type' => 'integer',
                ],
                'available' => [
                    'type' => 'integer',
                ],
                'total_capacity' => [
                    'type' => 'integer',
                ],
                'status' => [
                    'type' => 'integer',
                ],
                'rs_event_seat_map_id' => [
                    'type' => 'integer',
                ],
                'has_roster' => [
                    'type' => 'boolean',
                ],
                'is_private_event' => [
                    'type' => 'boolean',
                ],
                'has_holds' => [
                    'type' => 'boolean',
                ],
            ];

    }

}
