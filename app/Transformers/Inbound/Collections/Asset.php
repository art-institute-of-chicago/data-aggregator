<?php

namespace App\Transformers\Inbound\Collections;

use App\Transformers\Datum;
use App\Transformers\Inbound\CollectionsTransformer;

class Asset extends CollectionsTransformer
{

    protected function getIds(Datum $datum)
    {
        return [
            'lake_guid' => strval($datum->id),
            'netx_uuid' => \App\Models\Collections\Asset::getHashedId($datum->id),
        ];
    }

    protected function getExtraFields(Datum $datum)
    {
        return [
            'metadata' => (object) [
                'ahash' => $datum->ahash,
                'phash' => $datum->phash,
                'dhash' => $datum->dhash,
                'whash' => $datum->whash,
                'colorfulness' => round((float) $datum->colorfulness, 4),
                'color' => $datum->color,
                'lqip' => $datum->lqip,
            ],
        ];
    }
}
