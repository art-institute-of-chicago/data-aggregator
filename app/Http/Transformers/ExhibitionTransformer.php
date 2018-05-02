<?php

namespace App\Http\Transformers;

use App\Models\Collections\Exhibition;

class ExhibitionTransformer extends CollectionsTransformer
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'artworks',
        'venues',
        'sites',
    ];


    /**
     * Include artworks.
     *
     * @param  \App\Models\Collections\Exhibition  $exhibition
     * @return League\Fractal\ItemResource
     */
    public function includeArtworks(Exhibition $exhibition)
    {
        return $this->collection($exhibition->artworks, new ArtworkTransformer, false);
    }


    /**
     * Include venues.
     *
     * @param  \App\Models\Collections\Exhibition  $exhibition
     * @return League\Fractal\ItemResource
     */
    public function includeVenues(Exhibition $exhibition)
    {
        return $this->collection($exhibition->venues, new PivotTransformer, false);
    }


    /**
     * Include sites.
     *
     * @param  \App\Models\Collections\Exhibition  $exhibition
     * @return League\Fractal\ItemResource
     */
    public function includeSites(Exhibition $exhibition)
    {
        return $this->collection($exhibition->sites, new SiteTransformer, false);
    }

}
