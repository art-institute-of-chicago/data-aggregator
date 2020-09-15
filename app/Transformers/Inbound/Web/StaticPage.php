<?php

namespace App\Transformers\Inbound\Web;

use App\Transformers\Datum;
use App\Transformers\Inbound\WebTransformer;

class StaticPage extends WebTransformer
{

    protected function getExtraFields(Datum $datum)
    {
        return [
            'web_url' => $datum->url,
        ];
    }
}
