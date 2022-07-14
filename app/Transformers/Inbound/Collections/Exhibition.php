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
            'place_id' => $datum->gallery_id,
            'place_display' => $datum->gallery,
            'date_aic_start' => $datum->date('aic_start_date'),
            'date_aic_end' => $datum->date('aic_end_date'),
        ];
    }

    protected function getSync(Datum $datum)
    {
        $out = [
            'artworks' => $datum->all('artwork_ids'),
            'assets' => $this->getSyncAssets($datum),
        ];

        return $out;
    }

    /**
     * We do not allow something to be both documentation and representation.
     */
    private function getSyncAssets(Datum $datum)
    {
        return $this->getSyncPivots($datum, 'assets', 'netx_id', function ($pivot) {
            return [
                $pivot->netx_id => [
                    'is_preferred' => $pivot->is_preferred,
                    'is_doc' => $pivot->is_rep === false,
                ],
            ];
        });
    }
}
