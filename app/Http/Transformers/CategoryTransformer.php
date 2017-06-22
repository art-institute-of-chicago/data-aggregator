<?php

namespace App\Http\Transformers;

use App\Collections\Category;

class CategoryTransformer extends CollectionsTransformer
{

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Category  $item
     * @return array
     */
    public function transformFields($item)
    {
        return [
            'parent_id' => $item->parent_id,
            'is_in_nav' => $item->is_in_nav,
            'description' => $item->description,
            'sort' => $item->sort,
            'type' => $item->type,
        ];
    }
}