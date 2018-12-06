<?php

namespace App\Transformers\Inbound\Web;

use App\Transformers\Datum;
use App\Transformers\Inbound\WebTransformer;

class Hour extends WebTransformer
{

    protected function getTitle( Datum $datum )
    {

        return [
            'title' => $datum->id,
        ];

    }

}
