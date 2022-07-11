<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * A press release on the website
 */
class PressRelease extends WebModel
{
    protected $casts = [
        'publish_start_date' => 'datetime',
        'publish_end_date' => 'datetime',
        'is_published' => 'boolean',
    ];
}
