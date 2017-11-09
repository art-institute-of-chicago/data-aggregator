<?php

namespace App\Http\Transformers;

use App\Models\Collections\Gallery;

class GalleryTransformer extends CollectionsTransformer
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
     * @param  \App\Models\Collections\Gallery  $gallery
     * @return League\Fractal\ItemResource
     */
    public function includeCategories(Gallery $gallery)
    {
        return $this->collection($gallery->categories()->getResults(), new CategoryTransformer, false);
    }

}
