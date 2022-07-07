<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * Article on the website
 */
class IssueArticle extends WebModel
{
    protected $casts = [
        'is_published' => 'boolean',
        'date' => 'date',
        'publish_start_date' => 'datetime',
    ];
}
