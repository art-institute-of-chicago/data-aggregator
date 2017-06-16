<?php

namespace App\Http\Transformers;

use App\Collections\ObjectType;
use League\Fractal\TransformerAbstract;

class ObjectTypeTransformer extends TransformerAbstract
{

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\ObjectType  $item
     * @return array
     */
    public function transform(ObjectType $item)
    {
        return [
            'id' => $item->citi_id,
            'title' => $item->title,
            'last_updated_lpm_fedora' => $item->api_modified_at->toDateTimeString(),
            'last_updated_lpm_solr' => $item->api_indexed_at->toDateTimeString(),
            'last_updated' => $item->updated_at->toDateTimeString(),
        ];
    }
}