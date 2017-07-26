<?php

namespace App\Models\Mobile;

use App\Models\MobileModel;
use App\Models\SolrSearchable;

class TourStop extends MobileModel
{

    use SolrSearchable;

    protected $primaryKey = 'id';

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


    /**
     * Turn this model object into a generic array.
     *
     * @param boolean  $withTitles
     * @return array
     */
    public function transformFields()
    {

        return [
            'artwork' => $this->artwork->title,
            'artwork_id' => $this->artwork_citi_id,
            'mobile_sound' => $this->sound->link,
            'mobile_sound_id' => $this->sound_mobile_id,
            'weight' => $this->weight,
            'description' => $this->description,
        ];

    }

}
