<?php

namespace App\Transformers\Inbound\Enhancer;

use App\Transformers\Datum;
use App\Transformers\Inbound\Enhancer\AbstractEnhancerTransformer as BaseTransformer;

class Place extends BaseTransformer
{
    protected function getExtraFields(Datum $datum)
    {
        return [
            'tgn_id' => $datum->tgn_id,
        ];
    }
}
