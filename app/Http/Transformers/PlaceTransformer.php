<?php

namespace App\Http\Transformers;

use App\Models\Collections\Place;

class PlaceTransformer extends CollectionsTransformer
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
     * @param  \App\Models\Collections\Place  $place
     * @return League\Fractal\ItemResource
     */
    public function includeCategories(Place $place)
    {
        return $this->collection($place->categories()->getResults(), new CollectionsTransformer, false);
    }

}
