<?php

namespace App\Transformers\Inbound\Web;

use App\Transformers\Datum;
use App\Transformers\Inbound\WebTransformer;

class Experience extends WebTransformer
{
    use HasBlocks {
        getExtraFields as getBlockFields;
    }

    protected function getExtraFields(Datum $datum)
    {
        return array_merge($this->getBlockFields($datum), [
            // TODO: Move these to trait?
            'is_published' => $datum->is_published ?? $datum->published,
        ]);
    }
}
