<?php

namespace App\Transformers\Inbound\Collections;

use App\Transformers\Datum;

class Category extends BaseList
{
    protected function getExtraFields(Datum $datum)
    {
        return [
            'subtype' => $datum->type ? 'CT-' . $datum->type : null,
        ];
    }
}
