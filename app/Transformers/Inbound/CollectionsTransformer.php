<?php

namespace App\Transformers\Inbound;

use App\Transformers\Datum;

class CollectionsTransformer extends BaseTransformer
{

    protected function getIds( Datum $datum )
    {

        return  [
            'citi_id' => $datum->citi_id,
            'lake_uid' => $datum->lake_uid,
            'lake_guid' => $datum->lake_guid,
        ];

    }

}
