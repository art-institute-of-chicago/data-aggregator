<?php

namespace App\Transformers\Inbound\Queues;

use Illuminate\Support\Str;
use App\Transformers\Datum;
use App\Transformers\Inbound\BaseTransformer;

class WaitTime extends BaseTransformer
{
    protected function getExtraFields(Datum $datum)
    {
        return [
            'wait_display' => sprintf(
                '%s %s',
                $datum->duration,
                Str::plural($datum->units, $datum->duration)
            ),
        ];
    }
}
