<?php

namespace App\Transformers\Inbound\Library;

use App\Transformers\Datum;
use App\Transformers\Inbound\BaseTransformer;

class Material extends BaseTransformer
{

    protected function getSync(Datum $datum)
    {
        return [
            'creators' => collect($datum->creators)->pluck('id'),
            'subjects' => collect($datum->subjects)->pluck('id'),
        ];
    }
}
