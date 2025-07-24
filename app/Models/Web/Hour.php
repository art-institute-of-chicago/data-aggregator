<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * An event on the website
 */
class Hour extends WebModel
{
    protected $casts = [
        'monday_is_closed' => 'boolean',
        'tuesday_is_closed' => 'boolean',
        'wednesday_is_closed' => 'boolean',
        'thursday_is_closed' => 'boolean',
        'friday_is_closed' => 'boolean',
        'saturday_is_closed' => 'boolean',
        'sunday_is_closed' => 'boolean',
    ];
}
