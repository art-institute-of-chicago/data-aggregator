<?php

namespace App\Transformers\Inbound\Web;

use App\Transformers\Datum;
use App\Transformers\Inbound\WebTransformer;

class EventProgram extends WebTransformer
{

    protected function getExtraFields(Datum $datum)
    {
        return [
            'title' => $datum->name,
        ];
    }
}
