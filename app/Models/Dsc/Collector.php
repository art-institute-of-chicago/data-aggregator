<?php

namespace App\Models\Dsc;

class Collector extends DscModel
{

    public function publication()
    {

        return $this->belongsTo('App\Models\Dsc\Publication');

    }

}
