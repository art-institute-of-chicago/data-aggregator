<?php

namespace App\Http\Transformers;

use App\Collections\Department;
use League\Fractal\TransformerAbstract;

class DepartmentTransformer extends TransformerAbstract
{

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Department  $item
     * @return array
     */
    public function transform(Department $item)
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