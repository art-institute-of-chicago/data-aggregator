<?php

namespace App\Http\Transformers;

use App\Collections\Artwork;

class ArtworkTransformer extends CollectionsTransformer
{

    public $citiObject = true;

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['artists', 'categories', 'copyrightRepresentatives', 'parts', 'sets', 'dates', 'catalogues', 'committees', 'terms', 'images'];

    /**
     * List of resources to automatically include.
     *
     * @var array
     */
    protected $defaultIncludes = [];

    protected function transformFields($item)
    {

        return [
            'main_reference_number' => $item->main_id,
            'date_start' => $item->date_start,
            'date_end' => $item->date_end,
            'date_display' => $item->date_display,
            'description' => $item->description,
            'agent_display' => $item->agent_display,
            'department' => $item->department()->getResults() ? $item->department()->getResults()->title : '',
            'department_id' => $item->department_citi_id,
            'dimensions' => $item->dimensions,
            'medium' => $item->medium_display,
            'inscriptions' => $item->inscriptions,
            'object_type' => $item->objectType()->getResults() ? $item->objectType()->getResults()->title : '',
            'object_type_id' => $item->object_type_citi_id,
            'credit_line' => $item->credit_line,
            'publication_history' => $item->publications,
            'exhibition_history' => $item->exhibitions,
            'provenance_text' => $item->provenance,
            'publishing_verification_level' => $item->publishing_verification_level,
            'is_public_domain' => (bool) $item->is_public_domain,
            'copyright_notice' => $item->copyright_notice,
            'place_of_origin' => $item->place_of_origin,
            'collection_status' => $item->collection_status,
            'gallery' => $item->gallery()->getResults() ? $item->gallery()->getResults()->title : '',
            'gallery_id' => $item->gallery_citi_id,
            'is_in_gallery' => $item->gallery_citi_id ? true : false,
        ];

    }


    /**
     * Include artists.
     *
     * @param  \App\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeArtists(Artwork $artwork)
    {
        return $this->collection($artwork->artists()->getResults(), new AgentTransformer, false);
    }

    /**
     * Include copyright representatives.
     *
     * @param  \App\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeCopyrightRepresentatives(Artwork $artwork)
    {
        return $this->collection($artwork->copyrightRepresentatives()->getResults(), new AgentTransformer, false);
    }

    /**
     * Include categories.
     *
     * @param  \App\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeCategories(Artwork $artwork)
    {
        return $this->collection($artwork->categories()->getResults(), new CategoryTransformer, false);
    }

    /**
     * Include parts.
     *
     * @param  \App\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeParts(Artwork $artwork)
    {
        return $this->collection($artwork->parts()->getResults(), new ArtworkTransformer, false);
    }

    /**
     * Include sets.
     *
     * @param  \App\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeSets(Artwork $artwork)
    {
        return $this->collection($artwork->sets()->getResults(), new ArtworkTransformer, false);
    }

    /**
     * Include dates.
     *
     * @param  \App\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeDates(Artwork $artwork)
    {
        return $this->collection($artwork->dates()->getResults(), new ArtworkDateTransformer, false);
    }

    /**
     * Include catalogues.
     *
     * @param  \App\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeCatalogues(Artwork $artwork)
    {
        return $this->collection($artwork->catalogues()->getResults(), new ArtworkCatalogueTransformer, false);
    }

    /**
     * Include committees.
     *
     * @param  \App\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeCommittees(Artwork $artwork)
    {
        return $this->collection($artwork->committees()->getResults(), new ArtworkCommitteeTransformer, false);
    }

    /**
     * Include terms.
     *
     * @param  \App\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeTerms(Artwork $artwork)
    {
        return $this->collection($artwork->terms()->getResults(), new ArtworkTermTransformer, false);
    }

    /**
     * Include images.
     *
     * @param  \App\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeImages(Artwork $artwork)
    {
        return $this->collection($artwork->images()->getResults(), new ImageTransformer, false);
    }

}