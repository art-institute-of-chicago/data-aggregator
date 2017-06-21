<?php

namespace App\Http\Transformers;

use App\Collections\Asset;
use League\Fractal\TransformerAbstract;

class AssetTransformer extends ApiTransformer
{

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
     * @param  \App\Asset  $item
     * @return array
     */
    public function transformFields($item)
    {
        return array_merge(
            [
                'description' => $item->description,
                'content' => $item->content,
                'artist' => $item->artist()->getResults() ? $item->artist()->getResults()->title : '',
                'artist_id' => $item->agent_citi_id,
            ],
            $this->assetFields($item)
        );
    }

    /**
     * Provide a way for child classes add fields to the transformation.
     *
     * @param \App\Asset  $item
     * @return array
     */
    public function assetFields($item)
    {

        return [];

    }

    /**
     * Include categories.
     *
     * @param  \App\Collections\Asset  $asset
     * @return League\Fractal\ItemResource
     */
    public function includeCategories(Asset $asset)
    {
        return $this->collection($asset->categories()->getResults(), new CategoryTransformer);
    }
}