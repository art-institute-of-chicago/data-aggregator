<?php

namespace App\Transformers\Inbound\Web;

use App\Transformers\Datum;
use App\Transformers\Inbound\AbstractTransformer;

class EventProgram extends AbstractTransformer
{

    protected function getExtraFields( Datum $datum )
    {

        return [
            'title' => $datum->name,
        ];

    }

}
