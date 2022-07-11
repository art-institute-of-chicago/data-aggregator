<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * An event on the website
 */
class Event extends WebModel
{
    protected $casts = [
        'is_published' => 'boolean',
        'is_private' => 'boolean',
        'is_after_hours' => 'boolean',
        'is_ticketed' => 'boolean',
        'is_free' => 'boolean',
        'is_member_exclusive' => 'boolean',
        'is_admission_required' => 'boolean',
        'is_registration_required' => 'boolean',
        'is_sold_out' => 'boolean',
        'is_virtual_event' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'alt_event_types' => 'array',
        'alt_audiences' => 'array',
        'programs' => 'array',
    ];

    public function ticketedEvent()
    {
        return $this->belongsTo('App\Models\Membership\TicketedEvent', 'ticketed_event_id', 'id');
    }

    /**
     * @todo Consider filtering EventProgram by `is_event_host`, nulling this out if false.
     */
    public function eventHost()
    {
        return $this->belongsTo('App\Models\Web\EventProgram');
    }
}
