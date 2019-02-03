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
        'categories',
        'dates',
        'parts',
        'sets',
        'terms',
        'images',
        'documents',
        'publications',
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
     * Include categories.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeCategories(Artwork $artwork)
    {
        return $this->collection($artwork->categories, new CollectionsTransformer, false);
    }

    /**
     * Include parts.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeParts(Artwork $artwork)
    {
        return $this->collection($artwork->parts, new ArtworkTransformer, false);
    }

    /**
     * Include sets.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeSets(Artwork $artwork)
    {
        return $this->collection($artwork->sets, new ArtworkTransformer, false);
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
     * Include terms.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeTerms(Artwork $artwork)
    {
        return $this->collection($artwork->terms, new TermTransformer, false);
    }

    /**
     * Include images.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeImages(Artwork $artwork)
    {
        return $this->collection($artwork->images, new AssetTransformer, false);
    }

    /**
     * Include documents.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeDocuments(Artwork $artwork)
    {
        return $this->collection($artwork->documents, new AssetTransformer, false);
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
