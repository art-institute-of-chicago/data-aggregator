<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * An event on the website
 */
class EventProgram extends WebModel
{
    protected $casts = [
        'is_affiliate_group' => 'boolean',
        'is_event_host' => 'boolean',
    ];
}
