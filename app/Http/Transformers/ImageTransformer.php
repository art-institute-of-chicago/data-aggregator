<?php

namespace App\Http\Transformers;

use App\Collections\Image;

class ImageTransformer extends AssetTransformer
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['categories', 'artworks'];

    /**
     * List of resources to automatically include.
     *
     * @var array
     */
    protected $defaultIncludes = [];

    /**
     * Add fields to the transformation.
     *
     * @param \App\Image  $item
     * @return array
     */
    public function assetFields($item)
    {

        return [
            'type' => $item->type,
            'iiif_url' => $item->iiif_url,
            'preferred' => (bool) $item->preferred,
        ];

    }

    /**
     * Include artworks.
     *
     * @param  \App\Collections\Image  $image
     * @return League\Fractal\ItemResource
     */
    public function includeArtworks(Image $image)
    {
        return $this->collection($image->artworks()->getResults(), new ArtworkTransformer, false);
    }

}