<?php

namespace App\Http\Transformers;

use App\Models\Collections\ArtworkDate;

class ArtworkDateTransformer extends CollectionsTransformer
{

    public $excludeDates = true;

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Agent  $item
     * @return array
     */
    public function transformFields($item)
    {
        return [
            'date_earliest' => $item->date_earliest->toDateString(),
            'date_latest' => $item->date_latest->toDateString(),
            'artwork_date_qualifier_id' => $item->artwork_date_qualifier_citi_id,
            'is_preferred' => (bool) $item->preferred,
        ];
    }

}
