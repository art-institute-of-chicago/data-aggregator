<?php

namespace App\Models\Mobile;

use App\Models\MobileModel;
use App\Models\SolrSearchable;

class Tour extends MobileModel
{

    use SolrSearchable;

    public function intro()
    {

        return $this->belongsTo('App\Models\Mobile\Sound', 'intro_mobile_id');

    }

    public function stops()
    {

        return $this->hasMany('App\Models\Mobile\TourStop');

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
            'image' => $this->image,
            'description' => $this->description,
            'intro' => $this->intro_text,
            'weight' => $this->weight,
            'intro_link' => $this->intro->link,
            'intro_transcript' => $this->intro->transcript,
        ];

    }

}
