<?php

namespace App\Models\Mobile;

class Sound extends MobileModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mobile_app_sounds';

    public function artworks()
    {

        return $this->belongsToMany('App\Models\Collections\Artwork', 'artwork_mobile_app_sound');

    }

}
