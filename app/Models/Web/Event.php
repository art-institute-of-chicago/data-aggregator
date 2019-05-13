<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * An event on the website
 */
class Event extends WebModel
{

    protected $casts = [
        'published' => 'boolean',
        'is_private' => 'boolean',
        'is_after_hours' => 'boolean',
        'is_ticketed' => 'boolean',
        'is_free' => 'boolean',
        'is_member_exclusive' => 'boolean',
        'is_admission_required' => 'boolean',
        'is_registration_required' => 'boolean',
        'is_sold_out' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'alt_event_types' => 'array',
        'alt_audiences' => 'array',
        'programs' => 'array',
        'publish_start_date' => 'datetime',
        'publish_end_date' => 'datetime',
    ];

    public function ticketedEvent()
    {

        return $this->belongsTo('App\Models\Membership\TicketedEvent', 'ticketed_event_id', 'membership_id');

    }

}
