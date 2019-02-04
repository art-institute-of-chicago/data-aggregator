<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * Article on the website
 */
class Artist extends WebModel
{

    public $table = 'web_artists';

    protected $casts = [
        'published' => 'boolean',
        'also_known_as' => 'boolean',
    ];

}
