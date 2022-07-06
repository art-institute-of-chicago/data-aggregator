<?php

namespace App\Transformers\Inbound\Web;

use App\Transformers\Datum;
use App\Transformers\Inbound\WebTransformer;

class Artist extends WebTransformer
{

    protected function getTitle(Datum $datum)
    {
        return [
            'title' => $datum->datahub_id,
        ];
    }

    protected function getExtraFields(Datum $datum)
    {
        return [
            'intro_copy' => $datum->intro,
        ];
    }
}
