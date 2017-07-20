<?php

namespace App\Models\Mobile;

class TourStop extends MobileModel
{

    public function tour()
    {

        return $this->belongsTo('App\Models\Mobile\Tour');

    }

    public function artwork()
    {

        return $this->belongsTo('App\Models\Collections\Artwork');

    }

    public function sound()
    {

        return $this->belongsTo('App\Models\Mobile\Sound');

    }

}