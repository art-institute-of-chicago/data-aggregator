<?php

namespace App\Http\Transformers;

class CollectorTransformer extends DscTransformer
{

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Dsc\Figure  $item
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
        ];
    }

}