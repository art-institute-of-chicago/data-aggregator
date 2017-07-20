<?php

namespace App\Models\Mobile;

use App\Models\MobileModel;

class Tour extends MobileModel
{

    public function intro()
    {

        return $this->belongsTo('App\Models\Mobile\Sound', 'intro_mobile_id');

    }

    public function stops()
    {

        return $this->hasMany('App\Models\Mobile\TourStop');

    }

}