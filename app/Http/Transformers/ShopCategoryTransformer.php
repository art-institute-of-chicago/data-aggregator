<?php

namespace App\Http\Transformers;

use App\Shop\Category;

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

            'children' => $item->children()->getResults()->transform(function ($item, $key) {
                return array_merge(
                    $this->transformIdsAndTitle($item),
                    [
                        'link' => $item->link,
                        'parent_id' => $item->parent_category_shop_id,
                        'type' => $item->type,
                        'source_id' => $item->source_id,
                    ],
                    $this->transformDates($item)
                );
            }),
        ];
    }

}