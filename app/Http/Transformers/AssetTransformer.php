<?php

namespace App\Http\Transformers;

use App\Models\Collections\Asset;

class AssetTransformer extends CollectionsTransformer
{

    /**
     * Assets are native to LAKE, not CITI.
     *
     * @var boolean
     */
    public $citiObject = false;


    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['categories', 'artworks'];


    /**
     * Include categories.
     *
     * @param  \App\Models\Collections\Asset  $asset
     * @return League\Fractal\ItemResource
     */
    public function includeCategories(Asset $asset)
    {
        return $this->collection($asset->categories()->getResults(), new CollectionsTransformer, false);
    }


    /**
     * Include artworks.
     *
     * @param  \App\Models\Collections\Asset  $asset
     * @return League\Fractal\ItemResource
     */
    public function includeArtworks(Asset $asset)
    {
        return $this->collection($asset->artworks()->getResults(), new ArtworkTransformer, false);
    }

}
