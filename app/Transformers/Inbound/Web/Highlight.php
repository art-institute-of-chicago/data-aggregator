<?php

namespace App\Transformers\Inbound\Web;

use App\Transformers\Datum;
use App\Transformers\Inbound\WebTransformer;

class Highlight extends WebTransformer
{
    // Technically, we only need `copy`, but `imgix_url` gets pruned
    use HasBlocks;

    protected function getTitle(Datum $datum)
    {
        return [
            'title' => $datum->slug,
        ];
    }
}
