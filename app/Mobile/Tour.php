<?php

namespace App\Mobile;

class Tour extends MobileModel
{

    public function intro()
    {

        return $this->belongsTo('App\Mobile\Sound', 'intro_mobile_id');

    }

    public function stops()
    {

        return $this->hasMany('App\Mobile\TourStop');

    }

}