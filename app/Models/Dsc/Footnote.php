<?php

namespace App\Models\Dsc;

use App\Models\DscModel;

class Footnote extends DscModel
{

    protected $keyType = 'string';

    public function section()
    {

        return $this->belongsTo('App\Models\Dsc\Section');

    }

}
