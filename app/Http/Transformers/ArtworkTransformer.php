<?php

namespace App\Http\Transformers;

use App\Models\Collections\Artwork;

class ArtworkTransformer extends CollectionsTransformer
{

    public $citiObject = true;

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['artists', 'categories', 'copyrightRepresentatives', 'parts', 'sets', 'dates', 'catalogues', 'committees', 'terms', 'images', 'publications', 'tours'];

    /**
     * Include artists.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeArtists(Artwork $artwork)
    {
        return $this->collection($artwork->artists()->getResults(), new AgentTransformer, false);
    }

    /**
     * Include copyright representatives.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeCopyrightRepresentatives(Artwork $artwork)
    {
        return $this->collection($artwork->copyrightRepresentatives()->getResults(), new AgentTransformer, false);
    }

    /**
     * Include categories.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeCategories(Artwork $artwork)
    {
        return $this->collection($artwork->categories()->getResults(), new CategoryTransformer, false);
    }

    /**
     * Include parts.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeParts(Artwork $artwork)
    {
        return $this->collection($artwork->parts()->getResults(), new ArtworkTransformer, false);
    }

    /**
     * Include sets.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeSets(Artwork $artwork)
    {
        return $this->collection($artwork->sets()->getResults(), new ArtworkTransformer, false);
    }

    /**
     * Include dates.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeDates(Artwork $artwork)
    {
        return $this->collection($artwork->dates()->getResults(), new ArtworkDateTransformer, false);
    }

    /**
     * Include catalogues.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeCatalogues(Artwork $artwork)
    {
        return $this->collection($artwork->catalogues()->getResults(), new ArtworkCatalogueTransformer, false);
    }

    /**
     * Include committees.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeCommittees(Artwork $artwork)
    {
        return $this->collection($artwork->committees()->getResults(), new ArtworkCommitteeTransformer, false);
    }

    /**
     * Include terms.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeTerms(Artwork $artwork)
    {
        return $this->collection($artwork->terms()->getResults(), new ArtworkTermTransformer, false);
    }

    /**
     * Include images.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeImages(Artwork $artwork)
    {
        return $this->collection($artwork->images()->getResults(), new ImageTransformer, false);
    }

    /**
     * Include publications.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includePublications(Artwork $artwork)
    {
        return $this->collection($artwork->publications()->getResults(), new PublicationTransformer, false);
    }
    /**
     * Include tours.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeTours(Artwork $artwork)
    {
        return $this->collection($artwork->tours()->getResults(), new TourTransformer, false);
    }

}