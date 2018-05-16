<?php

namespace App\Transformers\Inbound;

use App\Transformers\Datum;

class DscTransformer extends AbstractTransformer
{

    protected function getIds( Datum $datum )
    {

        return [
            'dsc_id' => $datum->id,
        ];

    }

}
