<?php

namespace App\Transformers\Inbound\Collections;

use App\Transformers\Datum;

class Category extends BaseList
{

    protected function getIds( Datum $datum )
    {

        return  [
            'lake_uid' => $datum->id,
        ];

    }

    protected function getExtraFields( Datum $datum )
    {

        return [
            'subtype' => $datum->type ? 'CT-' . $datum->type : null,
        ];

    }

}
