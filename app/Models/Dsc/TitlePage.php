<?php

namespace App\Models\Dsc;

class TitlePage extends DscModel
{

    public function publication()
    {

        return $this->belongsTo('App\Models\Dsc\Publication');

    }

}
