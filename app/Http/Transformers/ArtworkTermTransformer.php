<?php

namespace App\Http\Transformers;

use App\Models\Collections\ArtworkTerm;

class ArtworkTermTransformer extends CollectionsTransformer
{

    public $excludeIdsAndTitle = true;

    /**
     * Turn this item object into a generic array.
     *
     * @TODO Verify this is actually being called..?
     *
     * @param  \App\Models\Collections\ArtworkTerm  $item
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
