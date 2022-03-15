<?php

namespace App\Transformers\Inbound\Enhancer;

use App\Transformers\Datum;
use App\Transformers\Inbound\Enhancer\AbstractEnhancerTransformer as BaseTransformer;

class Artwork extends BaseTransformer
{
    protected function getExtraFields(Datum $datum)
    {
        return [
            'support_aat_id' => $datum->support_aat_id,
            'dimension_width' => $datum->width,
            'dimension_height' => $datum->height,
        ];
    }
}
