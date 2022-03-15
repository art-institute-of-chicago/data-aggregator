<?php

namespace App\Transformers\Inbound\Enhancer;

use App\Transformers\Datum;
use App\Transformers\Inbound\Enhancer\AbstractEnhancerTransformer as BaseTransformer;

class Agent extends BaseTransformer
{
    protected function getExtraFields(Datum $datum)
    {
        return [
            'ulan_id' => $datum->ulan_id,
            'ulan_certainty' => $datum->ulan_certainty,
        ];
    }
}
