<?php

namespace App\Models\Membership;

use App\Models\MembershipModel;

/**
 * An occurrence of a program at the museum.
 */
class TicketedEventType extends MembershipModel
{

    protected $casts = [
        'source_created_at' => 'datetime',
    ];

}
