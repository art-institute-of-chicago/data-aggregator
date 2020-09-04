<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * Interactive feature on the website
 */
class InteractiveFeature extends WebModel
{

    protected $casts = [
        'archived' => 'boolean',
        'published' => 'boolean',
    ];
}
