<?php

namespace App\Models\Mobile;

use App\Models\MobileModel;
use App\Models\ElasticSearchable;

/**
 * A collection of audio tour stops to form a tour.
 */
class Tour extends MobileModel
{
    use ElasticSearchable;

    protected $with = [
        'intro',
        'tourStops',
    ];

    public function intro()
    {
        return $this->belongsTo('App\Models\Mobile\Sound', 'intro_id');
    }

    public function tourStops()
    {
        return $this->hasMany('App\Models\Mobile\TourStop', 'tour_id');
    }

    public function searchableImage()
    {
        return $this->image;
    }
}
