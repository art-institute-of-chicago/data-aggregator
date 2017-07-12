<?php

namespace App\Dsc;

class TitlePage extends DscModel
{

    public function publication()
    {

        return $this->belongsTo('App\Dsc\Publication');

    }

}
