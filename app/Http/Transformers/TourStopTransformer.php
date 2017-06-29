<?php

namespace App\Http\Transformers;

use App\Mobile\TourStop;

class TourStopTransformer extends ApiTransformer
{

    public $excludeIdsAndTitle = true;
    public $excludeDates = true;

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Mobile\Tour  $item
     * @return array
     */
    public function transformFields($item)
    {

        return [
            'artwork' => $item->artwork->title,
            'artwork_id' => $item->artwork_citi_id,
            'mobile_sound' => $item->sound->link,
            'mobile_sound_id' => $item->sound_mobile_id,
            'weight' => $item->weight,
        ];

    }

}