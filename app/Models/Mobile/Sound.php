<?php

namespace App\Models\Mobile;

use App\Models\MobileModel;

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

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Models\Mobile\Tour  $item
     * @return array
     */
    public function transformFields()
    {

        return [
            'link' => $this->link,
            'transcript' => $this->transcript,
        ];

    }

}
