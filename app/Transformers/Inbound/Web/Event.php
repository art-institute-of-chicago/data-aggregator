<?php

namespace App\Transformers\Inbound\Web;

use App\Transformers\Datum;
use App\Transformers\Inbound\WebTransformer;

class Event extends WebTransformer
{

    protected function getExtraFields(Datum $datum)
    {
        return [
            'start_date' => $datum->datetime('start_date'),
            'end_date' => $datum->datetime('end_date'),
            'type' => $datum->event_type,

            // TODO: Move these to trait?
            'is_published' => $datum->is_published ?? $datum->published,
        ];
    }

}
