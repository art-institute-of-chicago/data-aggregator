<?php

namespace App\Http\Transformers;

use App\Models\Dsc\Publication;

class TitlePageTransformer extends DscTransformer
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
            'publication' => $item->publication ? $item->publication->title : '',
            'publication_id' => $item->publication_dsc_id,
        ];
    }

}