<?php

namespace App\Models\Dsc;

use App\Models\DscModel;

class TitlePage extends DscModel
{

    public function publication()
    {

        return $this->belongsTo('App\Models\Dsc\Publication');

    }

}
