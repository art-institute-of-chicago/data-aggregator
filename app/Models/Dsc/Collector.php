<?php

namespace App\Models\Dsc;

use App\Models\DscModel;
use App\Models\SolrSearchable;

class Collector extends DscModel
{

    use SolrSearchable;

    public function publication()
    {

        return $this->belongsTo('App\Models\Dsc\Publication');

    }

}
