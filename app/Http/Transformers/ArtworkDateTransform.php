<?php

namespace App\Http\Transformers;

use App\Collections\ArtworkDate;
use League\Fractal\TransformerAbstract;

class ArtworkDateTransformer extends ApiTransformer
{

    public $excludeIdsAndTitle = true;
    public $excludeDates = true;

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\ArtworkDate  $item
     * @return array
     */
    public function transformFields(ArtworkDate $item)
    {
        return [
            'date' => $item->date->toDateString(),
            'qualifier' => $item->qualifier,
            'last_updated' => $item->updated_at->toDateTimeString(),
        ];
    }

}