<?php

namespace App\Transformers\Inbound\Collections;

use App\Transformers\Datum;
use App\Transformers\Inbound\CollectionsTransformer;

class Term extends CollectionsTransformer
{

    protected function getExtraFields( Datum $datum )
    {

        return [
            'subtype' => $datum->term_type_id ? 'TT-' . $datum->term_type_id : null,
        ];

    }

}
