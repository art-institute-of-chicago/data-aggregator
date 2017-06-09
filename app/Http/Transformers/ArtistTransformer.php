<?php

namespace App\Http\Transformers;

use App\Collections\Artist;
use League\Fractal\TransformerAbstract;

class ArtistTransformer extends TransformerAbstract
{

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Artist  $item
     * @return array
     */
    public function transform(Artist $item)
    {
        return [
            'id' => $item->citi_id,
            'title' => $item->title,
            'birth_date' => $item->date_birth,
            'death_date' => $item->date_death,
            'last_updated_lpm_fedora' => $item->api_modified_at->toDateTimeString(),
            'last_updated_lpm_solr' => $item->api_indexed_at->toDateTimeString(),
            'last_updated' => $item->updated_at->toDateTimeString(),
        ];
    }
}