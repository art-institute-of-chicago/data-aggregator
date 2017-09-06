<?php

namespace App\Http\Transformers;

use App\Models\Collections\Image;

class ImageTransformer extends AssetTransformer
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['categories', 'artworks'];

    /**
     * Include artworks.
     *
     * @param  \App\Models\Collections\Image  $image
     * @return League\Fractal\ItemResource
     */
    public function includeArtworks(Image $image)
    {
        return $this->collection($image->artworks()->getResults(), new ArtworkTransformer, false);
    }

}
