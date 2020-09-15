<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * Page on the website
 */
class Page extends WebModel
{

    protected $casts = [
        'publish_start_date' => 'datetime',
        'publish_end_date' => 'datetime',
        'is_published' => 'boolean',
    ];
}
