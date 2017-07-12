<?php

namespace App\Dsc;

class Section extends DscModel
{

    public function publication()
    {

        return $this->belongsTo('App\Dsc\Publication');

    }

}
