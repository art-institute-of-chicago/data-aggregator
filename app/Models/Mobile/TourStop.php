<?php

namespace App\Models\Mobile;

use App\Models\MobileModel;
use App\Models\SolrSearchable;

class TourStop extends MobileModel
{

    use SolrSearchable;

    public function tour()
    {

        return $this->belongsTo('App\Models\Mobile\Tour');

    }

    public function artwork()
    {

        return $this->belongsTo('App\Models\Collections\Artwork');

    }

    public function sound()
    {

        return $this->belongsTo('App\Models\Mobile\Sound');

    }

}
