<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * Article on the website
 */
class Artist extends WebModel
{
    public $table = 'web_artists';

    protected $touches = [
        'agent',
    ];

    public function agent()
    {
        return $this->belongsTo('App\Models\Collections\Agent');
    }
}
