<?php

namespace App\Http\Transformers;

use App\Shop\Product;

class ProductTransformer extends ApiTransformer
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['categories'];

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Shop\Product  $item
     * @return array
     */
    public function transformFields($item)
    {

        return [
            'title_display' => $item->title_display,
            'sku' => $item->sku,
            'link' => $item->link,
            'image' => $item->image,
            'description' => $item->description,
            'on_sale' => (bool) $item->on_sale,
            'priority' => $item->priority,
            'price' => $item->price,
            'review_count' => $item->review_count,
            'item_sold' => $item->item_sold,
            'rating' => $item->rating,
            'category_ids' => $item->categories->pluck('shop_id')->all(),
        ];

    }

    /**
     * Include categories.
     *
     * @param  \App\Shop\Product  $product
     * @return League\Fractal\ItemResource
     */
    public function includeCategories(Product $product)
    {
        return $this->collection($product->categories()->getResults(), new ShopCategoryTransformer, false);
    }

}