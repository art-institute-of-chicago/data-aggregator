<?php

namespace App\Http\Transformers;

use App\Models\Collections\ArtworkArtistPivot;

class ArtworkArtistPivotTransformer extends PivotTransformer
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'artist',
        'artwork',
        'role',
    ];

    /**
     * Include artist.
     *
     * @param  \App\Models\Collections\ArtworkArtistPivot  $pivot
     * @return League\Fractal\ItemResource
     */
    public function includeArtist(ArtworkArtistPivot $pivot)
    {
        return $this->item($pivot->artist, new AgentTransformer, false);
    }

    /**
     * Include artwork.
     *
     * @param  \App\Models\Collections\ArtworkArtistPivot  $pivot
     * @return League\Fractal\ItemResource
     */
    public function includeArtwork(ArtworkArtistPivot $pivot)
    {
        return $this->item($pivot->artwork, new ArtworkTransformer, false);
    }

    /**
     * Include agent role.
     *
     * @param  \App\Models\Collections\ArtworkArtistPivot  $pivot
     * @return League\Fractal\ItemResource
     */
    public function includeRole(ArtworkArtistPivot $pivot)
    {
        return $this->item($pivot->role, new CollectionsTransformer, false);
    }

}
