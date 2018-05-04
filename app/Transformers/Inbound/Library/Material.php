<?php

namespace App\Transformers\Inbound\Library;

use App\Transformers\Datum;
use App\Transformers\Inbound\AbstractTransformer;

class Material extends AbstractTransformer
{

    protected function attachFrom( Datum $datum )
    {

        return [
            'creators' => collect( $datum->creators )->pluck('id'),
            'subjects' => collect( $datum->subjects )->pluck('id'),
        ];

    }

}
