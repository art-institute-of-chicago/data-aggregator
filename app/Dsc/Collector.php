<?php

namespace App\Dsc;

class Collector extends DscModel
{

    public function publication()
    {

        return $this->belongsTo('App\Dsc\Publication');

    }

}
