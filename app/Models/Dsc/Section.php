<?php

namespace App\Models\Dsc;

class Section extends DscModel
{

    public function publication()
    {

        return $this->belongsTo('App\Models\Dsc\Publication');

    }

}
