<?php

namespace App\Http\Transformers;

use App\Collections\Gallery;

class GalleryTransformer extends CollectionsTransformer
{

    public $citiObject = true;

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['categories'];

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Gallery  $item
     * @return array
     */
    public function transformFields($item)
    {
        return [
            'closed' => $item->closed,
            'number' => $item->number,
            'floor' => $item->floor,
            'latitude' => $item->latitude,
            'longitude' => $item->longitude,
            'category_ids' => $item->categories->pluck('lake_guid')->all(),
        ];
    }

    /**
     * Include categories.
     *
     * @param  \App\Collections\Gallery  $gallery
     * @return League\Fractal\ItemResource
     */
    public function includeCategories(Gallery $gallery)
    {
        return $this->collection($gallery->categories()->getResults(), new CategoryTransformer, false);
    }
}