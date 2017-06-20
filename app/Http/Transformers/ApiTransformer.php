<?php

namespace App\Http\Transformers;

use App\Collections\Artwork;
use League\Fractal\TransformerAbstract;

class ApiTransformer extends ApiTransformer
{

    public $citiObject = false;
    public $excludeIdsAndTitle = false;
    public $excludeDates = false;

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Artwork  $item
     * @return array
     */
    public function transform(mixed $item)
    {

        return array_merge(
            $this->transformIdsAndTitle(),
            $this->transformFields(),
            $this->transformDates()
        );

    }

    protected function transformFields(mixed $item)
    {

        return [];

    }


    protected function transformIdsAndTitle(mixed $item)
    {

        if ($excludeIdsAndTitle)
        {

            return [];

        }

        return [
            'id' => $item->getAttributeValue($item->getKeyName()),
            'title' => $item->title,
        ];
        
    }

    protected function transformDates(mixed $item)
    {

        if ($excludeDates)
        {

            return [];

        }

        $ret = [];

        if ($citiObject)
        {

            $ret = [
                'created_citi' => $item->citi_created_at->toDateTimeString(),
                'last_updated_citi' => $item->citi_modified_at->toDateTimeString(),
            ];

        }

        return array_merge(
            $ret,
            [
                'last_updated_lpm_fedora' => $item->api_modified_at->toDateTimeString(),
                'last_updated_lpm_solr' => $item->api_indexed_at->toDateTimeString(),
                'last_updated' => $item->updated_at->toDateTimeString(),
            ]
        );

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