<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * An enhanced exhibition on the website
 */
class Exhibition extends WebModel
{

    public $table = 'web_exhibitions';

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];

    protected $touches = ['exhibition'];

    public function exhibition()
    {

        return $this->belongsTo('App\Models\Collections\Exhibition', 'datahub_id');

    }

}
