<?php

namespace App\Models\Mobile;

use App\Models\MobileModel;
use App\Models\ElasticSearchable;

/**
 * The audio file for a stop on a tour.
 */
class Sound extends MobileModel
{
    use ElasticSearchable;

    protected $table = 'mobile_sounds';

    public function artworks()
    {
        return $this->belongsToMany('App\Models\Mobile\Artwork', 'mobile_artwork_mobile_sound', 'mobile_sound_id', 'mobile_artwork_id');
    }

    public function stops()
    {
        return $this->hasMany('App\Models\Mobile\TourStop', 'mobile_sound_id');
    }

    public function introducedTours()
    {
        return $this->hasMany('App\Models\Mobile\Tour', 'intro_id');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Database\Factories\Mobile\SoundFactory::new();
    }
}
