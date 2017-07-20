<?php

namespace App\Http\Transformers;

use App\Collections\ArtworkCatalogue;

class ArtworkCatalogueTransformer extends CollectionsTransformer
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
            'is_preferred' => (bool) $item->preferred,
            'catalogue' => $item->catalogue,
            'number' => $item->number,
            'state_edition' => $item->state_edition,
        ];
    }
}