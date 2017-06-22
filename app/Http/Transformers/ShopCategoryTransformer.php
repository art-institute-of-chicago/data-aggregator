<?php

namespace App\Http\Transformers;

use App\Shop\ShopCategory;

class ShopCategoryTransformer extends ApiTransformer
{

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Shop\ShopCategory  $item
     * @return array
     */
    public function transformFields($item)
    {
        return [
            'link' => $item->link,
            'parent_id' => $item->parent_category_shop_id,
            'type' => $item->type,
            'source_id' => $item->source_id,
        ];
    }
}