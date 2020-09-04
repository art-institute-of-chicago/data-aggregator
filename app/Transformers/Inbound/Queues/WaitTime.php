<?php

namespace App\Transformers\Inbound\Queues;

use App\Transformers\Datum;
use App\Transformers\Inbound\BaseTransformer;

class WaitTime extends BaseTransformer
{

    protected function getExtraFields(Datum $datum)
    {
        return [
            'queue_id' => $datum->id,
        ];
    }
}
