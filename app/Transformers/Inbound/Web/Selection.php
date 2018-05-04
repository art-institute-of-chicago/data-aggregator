<?php

namespace App\Transformers\Inbound\Web;

use App\Transformers\Datum;
use App\Transformers\Inbound\AbstractTransformer;

class Selection extends AbstractTransformer
{

    protected function getTitle( Datum $datum )
    {

        return [
            'title' => $datum->slug,
        ];

    }

}
