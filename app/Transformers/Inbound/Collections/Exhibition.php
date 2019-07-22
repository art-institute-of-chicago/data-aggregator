<?php

namespace App\Transformers\Inbound\Collections;

use App\Transformers\Datum;
use App\Transformers\Inbound\CollectionsTransformer;

class Exhibition extends CollectionsTransformer
{

    protected function getExtraFields(Datum $datum)
    {
        return [
            'type' => $datum->exhibition_type,
            'status' => $datum->exhibition_status,
            'place_citi_id' => $datum->gallery_id,
            'place_display' => $datum->gallery,
            'date_start' => $datum->date('start_date'),
            'date_end' => $datum->date('end_date'),
            'date_aic_start' => $datum->date('aic_start_date'),
            'date_aic_end' => $datum->date('aic_end_date'),
            'source_indexed_at' => $datum->date('indexed_at'),
        ];
    }

    protected function getSync(Datum $datum)
    {
        return [
            'artworks' => $datum->all('artwork_ids'),
        ];
    }

}
