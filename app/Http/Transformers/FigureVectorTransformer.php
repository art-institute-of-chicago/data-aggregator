<?php

namespace App\Http\Transformers;

class FigureVectorTransformer extends DscTransformer
{

    public $excludeIdsAndTitle = true;
    public $excludeDates = true;

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Dsc\Figure  $item
     * @return array
     */
    public function transformFields($item)
    {
        return [
            'title' => $item->title,
            'link' => $item->link,
        ];
    }

}