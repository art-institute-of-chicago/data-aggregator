<?php

namespace App\Transformers\Inbound\Images;

use App\Transformers\Datum;
use App\Transformers\Inbound\BaseTransformer;

class Image extends BaseTransformer
{

    protected function getIds(Datum $datum)
    {
        return [
            'lake_guid' => $datum->id,
        ];
    }

    protected function getTitle(Datum $datum)
    {
        return [];
    }

    protected function getDates(Datum $datum)
    {
        return [];
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
                'lqip' => $datum->lqip,
                'color' => $datum->color,
            ],
        ];
    }
}
