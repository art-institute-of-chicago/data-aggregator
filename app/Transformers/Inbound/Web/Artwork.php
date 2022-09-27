<?php

namespace App\Transformers\Inbound\Web;

use App\Transformers\Datum;
use App\Transformers\Inbound\WebTransformer;

class Artwork extends WebTransformer
{
    protected function getTitle(Datum $datum)
    {
        return [];
    }

    protected function getExtraFields(Datum $datum)
    {
        return [
            'artwork_id' => $datum->datahub_id,
        ];
    }
}
