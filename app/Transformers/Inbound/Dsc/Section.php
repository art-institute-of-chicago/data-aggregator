<?php

namespace App\Transformers\Inbound\Dsc;

use App\Transformers\Datum;
use App\Transformers\Inbound\DscTransformer;

class Section extends DscTransformer
{
    protected function getExtraFields(Datum $datum)
    {
        return [
            'publication_dsc_id' => $datum->publication_id,
            'artwork_id' => $datum->id,
        ];
    }
}
