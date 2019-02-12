<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * Selections are a grouping of artworks on the website
 */
class Selection extends WebModel
{

    protected $casts = [
        'published' => 'boolean',
    ];

}
