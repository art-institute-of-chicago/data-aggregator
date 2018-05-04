<?php

namespace App\Transformers\Inbound\Collections;

use App\Transformers\Datum;
use App\Transformers\Inbound\CollectionsTransformer;

class Category extends CollectionsTransformer
{

    protected function getExtraFields( Datum $datum )
    {

        return [
            'parent_id' => $datum->parent_id ? 'PC-' . $datum->parent_id : null,
            'subtype' => $datum->type ? 'CT-' . $datum->type : null,
        ];

    }

}
