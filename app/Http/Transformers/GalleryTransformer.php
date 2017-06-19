<?php

namespace App\Http\Transformers;

use App\Collections\Gallery;
use League\Fractal\TransformerAbstract;

class GalleryTransformer extends TransformerAbstract
{

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Gallery  $item
     * @return array
     */
    public function transform(Gallery $item)
    {
        return [
            'id' => $item->citi_id,
            'title' => $item->title,
            'closed' => $item->closed,
            'number' => $item->number,
            'floor' => $item->floor,
            'latitude' => $item->latitude,
            'longitude' => $item->longitude,
            'last_updated_lpm_fedora' => $item->api_modified_at->toDateTimeString(),
            'last_updated_lpm_solr' => $item->api_indexed_at->toDateTimeString(),
            'last_updated' => $item->updated_at->toDateTimeString(),
        ];
    }
}