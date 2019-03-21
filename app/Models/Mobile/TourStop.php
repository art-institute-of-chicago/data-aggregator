<?php

namespace App\Models\Mobile;

use App\Models\MobileModel;
use App\Models\ElasticSearchable;

/**
 * An audio tour stops on a tour.
 */
class TourStop extends MobileModel
{

    use ElasticSearchable;

    protected $primaryKey = 'id';

    protected $with = [
        'artwork',
        'sound',
    ];

    public function tour()
    {

        return $this->belongsTo('App\Models\Mobile\Tour', 'tour_mobile_id');

    }

    public function artwork()
    {

        return $this->belongsTo('App\Models\Mobile\Artwork', 'mobile_artwork_mobile_id');

    }

    public function sound()
    {

        return $this->belongsTo('App\Models\Mobile\Sound', 'mobile_sound_mobile_id');

    }

}
