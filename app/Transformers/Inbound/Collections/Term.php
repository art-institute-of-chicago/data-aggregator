<?php

namespace App\Transformers\Inbound\Collections;

use App\Transformers\Datum;

class Term extends BaseList
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
            'subtype' => $datum->term_type_id ? 'TT-' . $datum->term_type_id : null,
        ];

    }

}
