<?php

namespace App\Http\Transformers;

use App\Models\Collections\Artwork;

use App\Transformers\Outbound\Collections\ArtworkArtistPivot as ArtworkArtistPivotTransformer;
use App\Transformers\Outbound\Collections\ArtworkCatalogue as ArtworkCatalogueTransformer;
use App\Transformers\Outbound\Collections\ArtworkDate as ArtworkDateTransformer;
use App\Transformers\Outbound\Collections\ArtworkPlacePivot as ArtworkPlacePivotTransformer;

class ArtworkTransformer extends CollectionsTransformer
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'artist_pivots',
        'place_pivots',
        'catalogue_pivots',
        'dates',
        'tours',
        'sites',
    ];


    /**
     * Include artists with pivots.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeArtistPivots(Artwork $artwork)
    {
        return $this->collection($artwork->artistPivots, new ArtworkArtistPivotTransformer, false);
    }

    /**
     * Include places with pivots.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includePlacePivots(Artwork $artwork)
    {
        return $this->collection($artwork->placePivots, new ArtworkPlacePivotTransformer, false);
    }

    /**
     * Include catalogues.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeCataloguePivots(Artwork $artwork)
    {
        return $this->collection($artwork->artworkCatalogues, new ArtworkCatalogueTransformer, false);
    }

    /**
     * Include dates.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeDates(Artwork $artwork)
    {
        return $this->collection($artwork->dates, new ArtworkDateTransformer, false);
    }

    /**
     * Include tours.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeTours(Artwork $artwork)
    {
        return $this->collection($artwork->tours, new TourTransformer, false);
    }

    /**
     * Include sites.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeSites(Artwork $artwork)
    {
        return $this->collection($artwork->sites, new SiteTransformer, false);
    }

}
