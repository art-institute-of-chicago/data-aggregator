<?php

namespace App\Models\Mobile;

use App\Models\MobileModel;

/**
 * The audio file for a stops on a tour.
 */
class Sound extends MobileModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mobile_sounds';

    public function artworks()
    {

        return $this->belongsToMany('App\Models\Mobile\Artwork', 'mobile_artwork_mobile_sound', 'mobile_sound_mobile_id', 'mobile_artwork_mobile_id');

    }

    public function stops()
    {

        return $this->hasMany('App\Models\Mobile\TourStop', 'mobile_sound_mobile_id');

    }

    public function introducedTours()
    {

        return $this->hasMany('App\Models\Mobile\Tour', 'intro_mobile_id');

    }

}
