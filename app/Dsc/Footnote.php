<?php

namespace App\Dsc;

class Footnote extends DscModel
{

    protected $keyType = 'string';

    public function section()
    {

        return $this->belongsTo('App\Dsc\Section');

    }

}
