<?php

namespace App\Transformers\Inbound\Web;

use App\Transformers\Datum;
use App\Transformers\Inbound\WebTransformer;

class Page extends WebTransformer
{

    use HasBlocks { getExtraFields as getBlockFields; }

    protected function getExtraFields(Datum $datum)
    {

        // TODO: Move these to trait?
        return array_merge($this->getBlockFields($datum), [
            'publish_start_date' => $datum->date('publish_start_date'),
            'publish_end_date' => $datum->date('publish_end_date'),
        ]);
    }

}
