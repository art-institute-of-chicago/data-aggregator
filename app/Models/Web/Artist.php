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
        'agent_ids' => 'array',
    ];

    protected $with = [
        'agent',
    ];

    protected $touches = [
        'agent',
    ];

    public function agent()
    {
        return $this->belongsTo('App\Models\Collections\Agent', 'datahub_id');
    }

}
