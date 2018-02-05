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
    protected $availableIncludes = ['artists', 'categories', 'copyright_representatives', 'parts', 'sets', 'dates', 'catalogues', 'committees', 'terms', 'images', 'publications', 'tours'];

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
     * Include copyright representatives.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeCopyrightRepresentatives(Artwork $artwork)
    {
        return $this->collection($artwork->copyrightRepresentatives, new CollectionsTransformer, false);
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
     * Include committees.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeCommittees(Artwork $artwork)
    {
        return $this->collection($artwork->committees, new ArtworkCommitteeTransformer, false);
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
     * Include tours.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeTours(Artwork $artwork)
    {
        return $this->collection($artwork->tours, new TourTransformer, false);
    }

}
