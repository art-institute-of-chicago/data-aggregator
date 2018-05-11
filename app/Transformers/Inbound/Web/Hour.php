<?php

namespace App\Transformers\Inbound\Web;

use App\Transformers\Datum;
use App\Transformers\Inbound\AbstractTransformer;

class Hour extends AbstractTransformer
{

    protected function getTitle( Datum $datum )
    {

        return [
            'title' => $datum->id,
        ];

    }

}
