<?php

namespace App\Transformers\Inbound;

use App\Transformers\Datum;

class DscTransformer extends BaseTransformer
{

    protected function getIds(Datum $datum)
    {
        return [
            'dsc_id' => $datum->id,
        ];
    }

}
