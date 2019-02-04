<?php

namespace App\Models\Mobile;

use App\Models\MobileModel;
use App\Models\ElasticSearchable;

/**
 * A collection of audio tour stops to form a tour.
 */
class Tour extends MobileModel
{

    use ElasticSearchable {
        getSuggestSearchFields as public traitGetSuggestSearchFields;
    }

    public function intro()
    {

        return $this->belongsTo('App\Models\Mobile\Sound', 'intro_mobile_id');

    }

    public function tourStops()
    {

        return $this->hasMany('App\Models\Mobile\TourStop', 'tour_mobile_id');

    }

    /**
     * Overrides method from ElasticSearchable. Tours should always contribute to autocomplete.
     *
     * @return array
     */
    public function getSuggestSearchFields()
    {

        $ret = $this->traitGetSuggestSearchFields();
        $ret['suggest_autocomplete_boosted'] = $this->title;

        return $ret;

    }


    public function searchableImage()
    {

        return $this->image;

    }

}
