<?php

namespace App\Http\Transformers;

use App\Models\Collections\Term;

class TermTransformer extends CollectionsTransformer
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
     * @param  \App\Models\Collections\Term  $term
     * @return League\Fractal\ItemResource
     */
    public function includeArtworks(Term $term)
    {
        return $this->collection($term->artworks()->getResults(), new CollectionsTransformer, false);
    }

}
