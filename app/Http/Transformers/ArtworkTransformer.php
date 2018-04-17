<?php

namespace App\Http\Transformers;

use App\Models\Collections\Artwork;

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
        'artists',
        'catalogues',
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
     * Include place with pivots.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includePlacePivots(Artwork $artwork)
    {
        return $this->collection($artwork->placePivots, new ArtworkPlacePivotTransformer, false);
    }

    /**
     * Include artists.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeArtists(Artwork $artwork)
    {
        return $this->collection($artwork->artists, new CollectionsTransformer, false);
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
    public function includeCatalogues(Artwork $artwork)
    {
        return $this->collection($artwork->catalogues, new ArtworkCatalogueTransformer, false);
    }

    /**
     * Include terms.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeTerms(Artwork $artwork)
    {
        return $this->collection($artwork->terms, new ArtworkTermTransformer, false);
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
