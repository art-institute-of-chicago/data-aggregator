<?php

namespace App\Http\Transformers;

use App\Collections\Exhibition;

class ExhibitionTransformer extends CollectionsTransformer
{

    public $citiObject = true;

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['artworks', 'venues'];

    protected function transformFields($item)
    {

        return [
            'description' => $item->description,
            'type' => $item->type,
            'department' => $item->department()->getResults() ? $item->department()->getResults()->title : '',
            'department_id' => $item->department_citi_id,
            'gallery' => $item->gallery()->getResults() ? $item->gallery()->getResults()->title : '',
            'gallery_id' => $item->gallery_citi_id,
            'dates' => $item->dates,
            'is_active' => (bool) $item->active,
            'artwork_ids' => $item->artworks->pluck('citi_id')->all(),
            'venue_ids' => $item->venues->pluck('citi_id')->all(),
        ];

    }


    /**
     * Include artworks.
     *
     * @param  \App\Collections\Exhibition  $exhibition
     * @return League\Fractal\ItemResource
     */
    public function includeArtworks(Exhibition $exhibition)
    {
        return $this->collection($exhibition->artworks()->getResults(), new ArtworkTransformer, false);
    }

    /**
     * Include venues.
     *
     * @param  \App\Collections\Exhibition  $exhibition
     * @return League\Fractal\ItemResource
     */
    public function includeVenues(Exhibition $exhibition)
    {
        return $this->collection($exhibition->venues()->getResults(), new AgentTransformer, false);
    }

}