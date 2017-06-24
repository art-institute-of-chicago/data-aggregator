<?php

namespace App\Http\Transformers;

use App\Collections\ArtworkTerm;

class ArtworkTermTransformer extends CollectionsTransformer
{

    public $excludeDates = true;
    public $excludeIdsAndTitle = true;

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Agent  $item
     * @return array
     */
    public function transformFields($item)
    {
        return [
            'term' => $item->term,
            'type' => $item->type,
        ];
    }
}