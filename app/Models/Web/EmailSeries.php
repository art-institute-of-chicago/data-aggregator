<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * Email series about an event.
 */
class EmailSeries extends WebModel
{

    protected $hasSourceDates = false;

    protected $casts = [
        'use_short_description' => 'boolean',
        'show_non_member' => 'boolean',
        'show_member' => 'boolean',
        'show_sustaining_fellow' => 'boolean',
        'show_affiliate_member' => 'boolean',
    ];

}
