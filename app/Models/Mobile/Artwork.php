<?php

namespace App\Models\Mobile;

use App\Models\MobileModel;

class Artwork extends MobileModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mobile_artworks';

    public function artwork()
    {

        return $this->belongsTo('App\Models\Collections\Artwork');

    }

    public function sounds()
    {

        return $this->belongsToMany('App\Models\Mobile\Sound', 'mobile_artwork_mobile_sound', 'mobile_artwork_mobile_id', 'mobile_sound_mobile_id');

    }


}
