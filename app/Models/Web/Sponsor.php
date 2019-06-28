<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * An event on the website
 */
class Sponsor extends WebModel
{

    protected $casts = [
        'published' => 'boolean',
    ];

    public function events()
    {

        return $this->hasMany('App\Models\Web\Event');

    }

}
