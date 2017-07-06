<?php

namespace App\Http\Transformers;

use App\StaticArchive\Site;

class SiteTransformer extends ApiTransformer
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['artworks'];

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\StaticArchive\Site  $item
     * @return array
     */
    public function transformFields($item)
    {

        return [
            'description' => $item->description,
            'link' => $item->link,
            'exhibition' => $item->exhibition ? $item->exhibition->title : "",
            'exhibition_id' => $item->exhibition_citi_id,
            'artwork_ids' => $item->artworks->pluck('citi_id')->all(),
        ];

    }

    /**
     * Include categories.
     *
     * @param  \App\StaticArchive\Site  $site
     * @return League\Fractal\ItemResource
     */
    public function includeArtworks(Site $site)
    {
        return $this->collection($site->artworks()->getResults(), new ArtworkTransformer, false);
    }

}