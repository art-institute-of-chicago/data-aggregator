<?php

namespace App\Transformers\Inbound\Web;

use App\Transformers\Datum;

class PageWithRelatedArtists extends Page
{

    protected function getExtraFields(Datum $datum)
    {
        return array_merge(
            parent::getExtraFields($datum),
            [
                'agent_ids' => collect($datum->related)->where('type', 'artists')->pluck('id')->all(),
            ]
        );
    }
}
