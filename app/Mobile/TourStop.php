<?php

namespace App\Mobile;

class TourStop extends MobileModel
{

    public function tour()
    {

        return $this->belongsTo('App\Mobile\Tour');

    }

    public function artwork()
    {

        return $this->belongsTo('App\Collections\Artwork');

    }

    public function sound()
    {

        return $this->belongsTo('App\Mobile\Sound');

    }

}