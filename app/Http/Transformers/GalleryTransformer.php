<?php

namespace App\Http\Transformers;

use App\Collections\Gallery;
use League\Fractal\TransformerAbstract;

class GalleryTransformer extends ApiTransformer
{

    public $citiObject = true;

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Gallery  $item
     * @return array
     */
    public function transformFields(Gallery $item)
    {
        return [
            'closed' => $item->closed,
            'number' => $item->number,
            'floor' => $item->floor,
            'latitude' => $item->latitude,
            'longitude' => $item->longitude,
        ];
    }
}