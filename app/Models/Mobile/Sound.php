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
    protected $table = 'mobile_app_sounds';

    public function artworks()
    {

        return $this->belongsToMany('App\Models\Collections\Artwork', 'artwork_mobile_app_sound');

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
