<?php

namespace App\Http\Transformers;

use App\Collections\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Category  $item
     * @return array
     */
    public function transform(Category $item)
    {
        return [
            'id' => $item->lake_guid,
            'title' => $item->title,
            'parent_id' => $item->parent_id,
            'is_in_nav' => $item->is_in_nav,
            'description' => $item->description,
            'sort' => $item->sort,
            'type' => $item->type,
            'last_updated_lpm_fedora' => $item->api_modified_at->toDateTimeString(),
            'last_updated_lpm_solr' => $item->api_indexed_at->toDateTimeString(),
            'last_updated' => $item->updated_at->toDateTimeString(),
        ];
    }
}