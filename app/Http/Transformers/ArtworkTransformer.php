<?php

namespace App\Http\Transformers;

use App\Collections\Artwork;
use App\Collections\Artist;
use League\Fractal\TransformerAbstract;

class ArtworkTransformer extends TransformerAbstract
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['creator']; // also 'department'

    /**
     * List of resources to automatically include.
     *
     * @var array
     */
    protected $defaultIncludes = []; // 'creator' or 'department'

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
            'artist_id' => $item->artist_citi_id,
            'artist_display' => $item->artist_display,
            'department_id' => $item->department_citi_id,
            'dimensions' => $item->dimensions,
            'medium' => $item->medium_display,
            'inscriptions' => $item->inscriptions,
            'credit_line' => $item->credit_line,
            'publication_history' => $item->publications,
            'exhibition_history' => $item->exhibitions,
            'provenance_text' => $item->provenance,
            'last_updated_lpm_fedora' => $item->api_modified_at->toDateTimeString(),
            'last_updated_lpm_solr' => $item->api_indexed_at->toDateTimeString(),
            'last_updated' => $item->updated_at->toDateTimeString(),
        ];
    }

    /**
     * Include creator.
     *
     * @param  \App\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeCreator(Artwork $artwork)
    {
        return $this->item(Artist::where('lake_uid', '=', $artwork->creator_lake_uid)->first(), new ArtistTransformer);
    }
}