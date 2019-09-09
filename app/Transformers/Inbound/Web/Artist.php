<?php

namespace App\Transformers\Inbound\Web;

use App\Transformers\Datum;
use App\Transformers\Inbound\WebTransformer;

class Artist extends WebTransformer
{

    protected function getTitle(Datum $datum)
    {
        return [
            'title' => $datum->datahub_id,
        ];
    }

    protected function getExtraFields(Datum $datum)
    {
        return [
            'agent_ids' => collect($datum->related)->where('type', 'artists')->pluck('id')->all(),
            'intro_copy' => $datum->intro,
        ];
    }

}
