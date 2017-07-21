<?php

namespace App\Http\Transformers;

class PublicationTransformer extends DscTransformer
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
            'link' => $item->link,
        ];
    }

}