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
    ];
}
