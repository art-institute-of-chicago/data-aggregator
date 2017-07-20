<?php

namespace App\Models\Dsc;

class Footnote extends DscModel
{

    protected $keyType = 'string';

    public function section()
    {

        return $this->belongsTo('App\Models\Dsc\Section');

    }

}
