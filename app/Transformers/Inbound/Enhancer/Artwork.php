<?php

namespace App\Transformers\Inbound\Enhancer;

use App\Transformers\Datum;
use App\Transformers\Inbound\Enhancer\AbstractEnhancerTransformer as BaseTransformer;

class Artwork extends BaseTransformer
{
    protected function getExtraFields(Datum $datum)
    {
        return [
            'dimension_width' => $datum->width,
            'dimension_height' => $datum->height,
            'linked_art_json' => $datum->linked_art_json,
            'nomisma_id' => $datum->nomisma_id,
            'short_description' => $datum->short_description,
        ];
    }
}
