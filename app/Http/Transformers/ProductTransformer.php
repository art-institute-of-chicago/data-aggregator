<?php

namespace App\Http\Transformers;

use App\Models\Shop\Product;

class ProductTransformer extends ApiTransformer
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['categories'];


    /**
     * Include categories.
     *
     * @param  \App\Models\Shop\Product  $product
     * @return League\Fractal\ItemResource
     */
    public function includeCategories(Product $product)
    {
        return $this->collection($product->categories()->getResults(), new ShopCategoryTransformer, false);
    }

}