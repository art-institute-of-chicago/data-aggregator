<?php

namespace App\Models\Membership;

use App\Models\MembershipModel;
use App\Models\ElasticSearchable;

/**
 * An occurrence of a program at the museum.
 */
class TicketedEvent extends MembershipModel
{

    use ElasticSearchable {
        getDefaultSearchFields as public traitGetDefaultSearchFields;
    }

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'on_sale_at' => 'datetime',
        'off_sale_at' => 'datetime',
        'is_after_hours' => 'boolean',
        'is_private_event' => 'boolean',
        'is_admission_required' => 'boolean',
    ];

    protected $touches = [
        'event',
    ];

    public function event()
    {
        return $this->hasOne('App\Models\Web\Event', 'ticketed_event_id', 'membership_id');
    }

    public function ticketedEventType()
    {
        return $this->belongsTo('App\Models\Membership\TicketedEventType', 'event_type_id');
    }

    public function searchableImage()
    {
        return $this->image_url;
    }

    public function getDefaultSearchFields($isExact)
    {
        $fields = $this->traitGetDefaultSearchFields($isExact);

        return array_merge(['id.text^1.0'], $fields);
    }
}
