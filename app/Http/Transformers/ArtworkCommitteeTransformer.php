<?php

namespace App\Http\Transformers;

use App\Collections\ArtworkCommittee;

class ArtworkCommitteeTransformer extends CollectionsTransformer
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
            'committee' => $item->committee,
            'date' => $item->date->toDateString(),
            'action' => $item->action,
       ];
    }
}