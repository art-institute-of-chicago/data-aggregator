<?php

namespace App\Transformers\Inbound;

use Carbon\Carbon;

use App\Transformers\Datum;
use App\Transformers\Inbound\AbstractTransformer;

class DigitalLabelTransformer extends AbstractTransformer
{

    protected function getDates( Datum $datum )
    {

        return [
            'source_created_at' => $datum->whenCreated / 1000,
            'source_modified_at' => $datum->whenChanged / 1000,
        ];

    }

}
