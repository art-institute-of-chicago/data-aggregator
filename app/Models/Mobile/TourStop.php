<?php

namespace App\Models\Mobile;

use App\Models\MobileModel;

/**
 * An audio tour stops on a tour.
 */
class TourStop extends MobileModel
{
    protected $primaryKey = 'id';

    protected $with = [
        'artwork',
        'sound',
    ];

    public function tour()
    {
        return $this->belongsTo('App\Models\Mobile\Tour', 'tour_id');
    }

    public function artwork()
    {
        return $this->belongsTo('App\Models\Mobile\Artwork', 'mobile_artwork_id');
    }

    public function sound()
    {
        return $this->belongsTo('App\Models\Mobile\Sound', 'mobile_sound_id');
    }
}
