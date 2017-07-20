<?php

namespace App\Http\Transformers;

use App\Models\Dsc\WorkOfArt;

class WorkOfArtTransformer extends DscTransformer
{

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Models\Dsc\Publication  $item
     * @return array
     */
    public function transformFields($item)
    {
        return [
            'content' => $item->content,
            'weight' => $item->weight,
            'depth' => $item->depth,
            'publication' => $item->publication ? $item->publication->title : '',
            'publication_id' => $item->publication_dsc_id,
            'artwork' => $item->artwork ? $item->artwork->title : '',
            'artwork_id' => $item->artwork_citi_id,
        ];
    }

}