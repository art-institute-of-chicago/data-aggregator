<?php

namespace App\Http\Transformers;

use App\Collections\Gallery;
use League\Fractal\TransformerAbstract;

class GalleryTransformer extends ApiTransformer
{

    public $citiObject = true;

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['categories'];

    /**
     * List of resources to automatically include.
     *
     * @var array
     */
    protected $defaultIncludes = ['categories'];

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
        return $this->collection($gallery->categories()->getResults(), new CategoryTransformer);
    }
}