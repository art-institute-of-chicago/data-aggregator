<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * Article on the website
 */
class Issue extends WebModel
{

    protected $casts = [
        'published' => 'boolean',
        'date' => 'date',
        'publish_start_date' => 'datetime',
    ];
}
