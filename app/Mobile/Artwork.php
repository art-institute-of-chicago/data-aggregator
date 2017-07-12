<?php

namespace App\Mobile;

class Artwork extends MobileModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mobile_app_artworks';

    public function artwork()
    {

        return $this->belongsTo('App\Collections\Artwork');

    }

}
