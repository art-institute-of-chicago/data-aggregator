<?php

namespace App\Http\Transformers;

use App\Models\Collections\ArtworkPlacePivot;

class ArtworkPlacePivotTransformer extends PivotTransformer
{

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
     * Include artists with pivots.
     *
     * @param  \App\Models\Collections\ArtworkPlacePivot  $pivot
     * @return League\Fractal\ItemResource
     */
    public function includeArtwork(ArtworkPlacePivot $pivot)
    {
        return $this->item($pivot->artwork, new ArtworkTransformer, false);
    }

    /**
     * Include artists with pivots.
     *
     * @param  \App\Models\Collections\ArtworkPlacePivot  $pivot
     * @return League\Fractal\ItemResource
     */
    public function includePlace(ArtworkPlacePivot $pivot)
    {
        return $this->item($pivot->place, new PlaceTransformer, false);
    }

    /**
     * Include artists with pivots.
     *
     * @param  \App\Models\Collections\ArtworkPlacePivot  $pivot
     * @return League\Fractal\ItemResource
     */
    public function includeQualifier(ArtworkPlacePivot $pivot)
    {
        return $this->item($pivot->qualifier, new CollectionsTransformer, false);
    }

}
