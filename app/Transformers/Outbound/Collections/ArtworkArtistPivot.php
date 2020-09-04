<?php

namespace App\Transformers\Outbound\Collections;

use App\Transformers\Outbound\Collections\Artwork as ArtworkTransformer;
use App\Transformers\Outbound\Collections\Agent as AgentTransformer;
use App\Transformers\Outbound\CollectionsTransformer;

use App\Transformers\Outbound\Collections\Traits\HidesDefaultFields;

use App\Transformers\Outbound\CollectionsTransformer as BaseTransformer;

class ArtworkArtistPivot extends BaseTransformer
{
    use HidesDefaultFields;

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
     * @return \League\Fractal\Resource\Item
     */
    public function includeArtist($pivot)
    {
        return $this->item($pivot->artist, new AgentTransformer(), false);
    }

    /**
     * Include artwork.
     *
     * @param  \App\Models\Collections\ArtworkArtistPivot  $pivot
     * @return \League\Fractal\Resource\Item
     */
    public function includeArtwork($pivot)
    {
        return $this->item($pivot->artwork, new ArtworkTransformer(), false);
    }

    /**
     * Include agent role.
     *
     * @param  \App\Models\Collections\ArtworkArtistPivot  $pivot
     * @return \League\Fractal\Resource\Item
     */
    public function includeRole($pivot)
    {
        return $this->item($pivot->role, new CollectionsTransformer(), false);
    }

    protected function getFields()
    {
        return [
            // TODO: Rename to `is_preferred`
            'preferred' => [
                'doc' => 'Whether this is a preferred artist',
                'type' => 'boolean',
            ],
            'artist_title' => [
                'doc' => 'Name of the artist',
                'type' => 'string',
                'value' => function ($item) {
                    return $item->artist->title ?? null;
                },
            ],
            'artist_id' => [
                'doc' => 'Unique identifier of the artist',
                'type' => 'number',
                'value' => function ($item) {
                    return $item->artist->citi_id ?? null;
                },
            ],
            'role_title' => [
                'doc' => 'Name of the role this artist played in the making of the work',
                'type' => 'string',
                'value' => function ($item) {
                    return $item->role->title ?? null;
                },
            ],
            'role_id' => [
                'doc' => 'Unique identifier of the role this artist played in the making of the work',
                'type' => 'number',
                'value' => function ($item) {
                    return $item->role->citi_id ?? null;
                },
            ],
        ];
    }
}
