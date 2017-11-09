<?php

namespace App\Http\Transformers;

use App\Models\Collections\Asset;

class AssetTransformer extends CollectionsTransformer
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
     * @param  \App\Models\Collections\Asset  $asset
     * @return League\Fractal\ItemResource
     */
    public function includeCategories(Asset $asset)
    {
        return $this->collection($asset->categories()->getResults(), new CategoryTransformer, false);
    }

}
