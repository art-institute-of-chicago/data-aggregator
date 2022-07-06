<?php

namespace App\Transformers\Inbound\Web;

use App\Transformers\Datum;
use App\Transformers\Inbound\WebTransformer;

class Exhibition extends WebTransformer
{

    protected function getExtraFields(Datum $datum)
    {
        return [
            'is_published' => $datum->published,

            'public_start_at' => $datum->datetime('public_start_at'),
            'public_end_at' => $datum->datetime('public_end_at'),
        ];
    }
}
