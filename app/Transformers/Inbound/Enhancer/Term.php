<?php

namespace App\Transformers\Inbound\Enhancer;

use App\Transformers\Datum;
use App\Transformers\Inbound\Enhancer\AbstractEnhancerTransformer as BaseTransformer;

class Term extends BaseTransformer
{
    protected function getExtraFields(Datum $datum)
    {
        return [
            'aat_id' => $datum->aat_id,
        ];
    }
}
