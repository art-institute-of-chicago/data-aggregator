<?php

namespace App\Transformers\Outbound\Collections;

use App\Transformers\Outbound\Collections\Artwork as ArtworkTransformer;
use App\Transformers\Outbound\Collections\Place as PlaceTransformer;
use App\Transformers\Outbound\CollectionsTransformer;

use App\Transformers\Outbound\Collections\Traits\HidesDefaultFields;

use App\Transformers\Outbound\CollectionsTransformer as BaseTransformer;

class ArtworkPlacePivot extends BaseTransformer
{

    use HidesDefaultFields;

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'artwork',
        'place',
        'qualifier',
    ];

    /**
     * Include artwork.
     *
     * @param  \App\Models\Collections\ArtworkPlacePivot  $pivot
     * @return \League\Fractal\Resource\Item
     */
    public function includeArtwork($pivot)
    {
        return $this->item($pivot->artwork, new ArtworkTransformer(), false);
    }

    /**
     * Include place.
     *
     * @param  \App\Models\Collections\ArtworkPlacePivot  $pivot
     * @return \League\Fractal\Resource\Item
     */
    public function includePlace($pivot)
    {
        return $this->item($pivot->place, new PlaceTransformer(), false);
    }

    /**
     * Include artwork place qualifier.
     *
     * @param  \App\Models\Collections\ArtworkPlacePivot  $pivot
     * @return \League\Fractal\Resource\Item
     */
    public function includeQualifier($pivot)
    {
        return $this->item($pivot->qualifier, new CollectionsTransformer(), false);
    }

    protected function getFields()
    {
        return [
            // TODO: Rename to `is_preferred`
            'preferred' => [
                'doc' => 'Whether this is the preferred place to represent this work',
                'type' => 'boolean',
            ],

            // TODO: Refactor relationships:
            'artwork_title' => [
                'doc' => 'Name of the work associated with this place',
                'type' => 'string',
                'value' => function ($item) {
                    return $item->artwork->title ?? null;
                },
            ],
            'artwork_id' => [
                'doc' => 'Unique identifier of the work associated with this place',
                'type' => 'number',
                'value' => function ($item) {
                    return $item->artwork->citi_id ?? null;
                },
            ],
            'place_title' => [
                'doc' => 'Name of the place associated with this work',
                'type' => 'string',
                'value' => function ($item) {
                    return $item->place->title ?? null;
                },
            ],
            'place_id' => [
                'doc' => 'Unique identifier of the place associated with this work',
                'type' => 'number',
                'value' => function ($item) {
                    return $item->place->citi_id ?? null;
                },
            ],
            'qualifier_title' => [
                'doc' => 'Name of the qualifier indicating what happened to the work here',
                'type' => 'string',
                'value' => function ($item) {
                    return $item->qualifier->title ?? null;
                },
            ],
            'qualifier_id' => [
                'doc' => 'Unique identifier of the qualifier indicating what happened to the work here',
                'type' => 'number',
                'value' => function ($item) {
                    return $item->qualifier->citi_id ?? null;
                },
            ],
        ];
    }
}
