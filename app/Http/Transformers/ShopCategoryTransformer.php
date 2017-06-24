<?php

namespace App\Http\Transformers;

use App\Shop\Category;

class ShopCategoryTransformer extends ApiTransformer
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['children'];

    /**
     * List of resources to automatically include.
     *
     * @var array
     */
    protected $defaultIncludes = [];

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

    /**
     * Include categories.
     *
     * @param  \App\Collections\Category  $category
     * @return League\Fractal\ItemResource
     */
    public function includeChildren(Category $category)
    {
        return $this->collection($category->children()->getResults(), new ShopCategoryTransformer, false);
    }
    
}