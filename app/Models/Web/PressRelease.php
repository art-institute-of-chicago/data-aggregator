<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * A press release on the website
 */
class PressRelease extends WebModel
{
    protected $casts = [
        'is_published' => 'boolean',
    ];
}
