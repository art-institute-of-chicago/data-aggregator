<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * Artwork on the website
 */
class Artwork extends WebModel
{
    public $table = 'web_artworks';

    protected $touches = [
        'artwork',
    ];

    protected $casts = [
        'has_advanced_imaging' => 'boolean',
    ];

    public function artwork()
    {
        return $this->belongsTo('App\Models\Collections\Artwork');
    }
}
