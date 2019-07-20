<?php

namespace App\Transformers\Inbound;

use App\Transformers\Datum;

class DigitalLabelTransformer extends BaseTransformer
{

    protected function getDates(Datum $datum)
    {

        return [
            'source_created_at' => $datum->whenCreated / 1000,
            'source_modified_at' => $datum->whenChanged / 1000,
        ];

    }

}
