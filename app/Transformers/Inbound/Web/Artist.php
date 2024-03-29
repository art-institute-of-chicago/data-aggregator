<?php

namespace App\Transformers\Inbound\Web;

use App\Transformers\Datum;
use App\Transformers\Inbound\WebTransformer;

class Artist extends WebTransformer
{
    protected function getTitle(Datum $datum)
    {
        return [];
    }

    protected function getExtraFields(Datum $datum)
    {
        return [
            'agent_id' => $datum->datahub_id,
            'intro_copy' => $datum->intro,
        ];
    }
}
