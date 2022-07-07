<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * Article on the website
 */
class Article extends WebModel
{

    protected $casts = [
        'is_published' => 'boolean',
        'date' => 'date',
        'publish_start_date' => 'datetime',
        'publish_end_date' => 'datetime',
        'is_unlisted' => 'boolean',
    ];
}
