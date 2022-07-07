<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * Highlights are a grouping of artworks on the website
 */
class Highlight extends WebModel
{
    protected $casts = [
        'is_published' => 'boolean',
        'publish_start_date' => 'datetime',
        'publish_end_date' => 'datetime',
        'is_unlisted' => 'boolean',
    ];
}
