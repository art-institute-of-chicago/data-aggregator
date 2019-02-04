<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * Closure on the website
 */
class Closure extends WebModel
{

    protected $casts = [
        'published' => 'boolean',
        'date_start' => 'date',
        'date_end' => 'date',
    ];

}
