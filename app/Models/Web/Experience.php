<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * Interactive feature experience on the website
 */
class Experience extends WebModel
{

    protected $casts = [
        'archived' => 'boolean',
        'kiosk_only' => 'boolean',
        'published' => 'boolean',
        'is_unlisted' => 'boolean',
    ];
}
