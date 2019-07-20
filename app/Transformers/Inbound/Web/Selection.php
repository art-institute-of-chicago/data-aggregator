<?php

namespace App\Transformers\Inbound\Web;

use App\Transformers\Datum;
use App\Transformers\Inbound\WebTransformer;

class Selection extends WebTransformer
{

    // Technically, we only need `copy`, but `imgix_url` gets pruned
    use HasBlocks;

    protected function getTitle(Datum $datum)
    {

        return [
            'title' => $datum->slug,

            // TODO: Move these to trait?
            'publish_start_date' => $datum->date('publish_start_date'),
            'publish_end_date' => $datum->date('publish_end_date'),
        ];

    }

}
