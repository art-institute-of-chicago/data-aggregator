<?php

namespace App\Models\Dsc;

use App\Models\DscModel;

class Section extends DscModel
{

    public function publication()
    {

        return $this->belongsTo('App\Models\Dsc\Publication');

    }

}
