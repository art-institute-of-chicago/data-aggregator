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

    protected function transformFields($item)
    {

        return array_merge(
            [
                'main_reference_number' => $item->main_id,
                'date_start' => $item->date_start,
                'date_end' => $item->date_end,
                'date_display' => $item->date_display,
                'description' => $item->description,
                'agent_display' => $item->agent_display,
                'department' => $item->department ? $item->department->title : NULL,
                'department_id' => $item->department_citi_id,
                'dimensions' => $item->dimensions,
                'medium' => $item->medium_display,
                'inscriptions' => $item->inscriptions,
                'object_type' => $item->objectType ? $item->objectType->title : NULL,
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
                'gallery' => $item->gallery ? $item->gallery->title : '',
                'gallery_id' => $item->gallery_citi_id,
                'is_in_gallery' => $item->gallery_citi_id ? true : false,
            ],
            $this->_addMobileArtworkFields($item),
            [
                'artist_ids' => $item->artists->pluck('citi_id')->all(),
                'category_ids' => $item->categories->pluck('lake_guid')->all(),
                'copyright_representative_ids' => $item->copyrightRepresentatives->pluck('citi_id')->all(),
                'part_ids' => $item->parts->pluck('citi_id')->all(),
                'set_ids' => $item->sets->pluck('citi_id')->all(),
                'date_dates' => $item->dates->pluck('date')->transform(function ($item, $key) {
                    return $item->toDateString();
                })->all(),
                'catalogue_titles' => $item->catalogues->pluck('catalogue')->all(),
                'committee_titles' => $item->committees->pluck('committee')->all(),
                'term_titles' => $item->terms->pluck('term')->all(),
                'image_urls' => $item->images->pluck('iiif_url')->all(),
            ]
        );

    }

    private function _addMobileArtworkFields($item)
    {

        if ($item->mobileArtwork) {

            return [

                'latitude' => $item->mobileArtwork->latitude,
                'longitude' => $item->mobileArtwork->longitude,
                'hightlight_in_mobile' => (bool) $item->mobileArtwork->highlighted,
                'selector_number' => $item->mobileArtwork->selector_number,

            ];

        }

        return [];

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