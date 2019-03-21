<?php

namespace App\Transformers\Inbound\Collections;

use App\Transformers\Datum;

class Category extends BaseList
{

    protected function getIds( Datum $datum )
    {

        return  [
            'lake_uid' => $datum->lake_uid,
            'citi_id' => $datum->citi_id,
            'lake_guid' => $datum->lake_guid,
        ];

    }

    protected function getExtraFields( Datum $datum )
    {

        return [
            'parent_id' => $datum->parent_id ? 'PC-' . $datum->parent_id : null,
            'subtype' => $datum->type ? 'CT-' . $datum->type : null,
        ];

    }

}
