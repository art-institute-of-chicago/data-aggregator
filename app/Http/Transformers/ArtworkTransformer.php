<?php

namespace App\Http\Transformers;

use App\Collections\Artwork;
use League\Fractal\TransformerAbstract;

class ArtworkTransformer extends TransformerAbstract
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['artists', 'galleries', 'categories', 'copyrightRepresentatives', 'parts', 'sets',];

    /**
     * List of resources to automatically include.
     *
     * @var array
     */
    protected $defaultIncludes = ['artists', 'galleries', 'categories', 'copyrightRepresentatives']; //, 'parts', 'sets'];

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Artwork  $item
     * @return array
     */
    public function transform(Artwork $item)
    {

        return [
            'id' => $item->citi_id,
            'title' => $item->title,
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
            'last_updated_lpm_fedora' => $item->api_modified_at->toDateTimeString(),
            'last_updated_lpm_solr' => $item->api_indexed_at->toDateTimeString(),
            'last_updated' => $item->updated_at->toDateTimeString(),
            // Doing it this way so we don't get an extra 'data' block
            'dates' => $item->dates()->getResults()->transform(function ($item, $key) {
                return [
                    'date' => $item->date->toDateString(),
                    'qualifier' => $item->qualifier,
                    'preferred' => (bool) $item->preferred,
                ];
            }),
            'catalogues' => $item->catalogues()->getResults()->transform(function ($item, $key) {
                return [
                    'preferred' => (bool) $item->preferred,
                    'catalogue' => $item->catalogue,
                    'number' => $item->number,
                    'state_edition' => $item->state_edition,
                ];
            }),
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
        return $this->collection($artwork->artists()->getResults(), new AgentTransformer);
    }

    /**
     * Include copyright representatives.
     *
     * @param  \App\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeCopyrightRepresentatives(Artwork $artwork)
    {
        return $this->collection($artwork->copyrightRepresentatives()->getResults(), new AgentTransformer);
    }

    /**
     * Include galleries.
     *
     * @param  \App\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeGalleries(Artwork $artwork)
    {
        return $this->collection($artwork->galleries()->getResults(), new GalleryTransformer);
    }

    /**
     * Include categories.
     *
     * @param  \App\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeCategories(Artwork $artwork)
    {
        return $this->collection($artwork->categories()->getResults(), new CategoryTransformer);
    }

    /**
     * Include parts.
     *
     * @param  \App\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeParts(Artwork $artwork)
    {
        return $this->collection($artwork->parts()->getResults(), new ArtworkTransformer);
    }

    /**
     * Include sets.
     *
     * @param  \App\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeSets(Artwork $artwork)
    {
        return $this->collection($artwork->sets()->getResults(), new ArtworkTransformer);
    }

}