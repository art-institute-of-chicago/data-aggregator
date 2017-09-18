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

        // This is also on the Artwork side... we should consider relating it to mobile artwork instead..?
        return $this->belongsToMany('App\Models\Collections\Artwork', 'artwork_mobile_sound');

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
