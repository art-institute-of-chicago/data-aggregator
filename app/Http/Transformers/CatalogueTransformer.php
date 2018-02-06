<?php

namespace App\Http\Transformers;

use App\Models\Collections\Catalogue;

class CatalogueTransformer extends CollectionsTransformer
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['artworks'];


    /**
     * Include categories.
     *
     * @param  \App\Models\Collections\Catalogue  $catalogue
     * @return League\Fractal\ItemResource
     */
    public function includeArtworks(Catalogue $catalogue)
    {
        return $this->collection($catalogue->artworks, new CollectionsTransformer, false);
    }

}
