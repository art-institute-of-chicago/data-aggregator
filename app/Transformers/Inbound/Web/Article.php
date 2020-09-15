<?php

namespace App\Transformers\Inbound\Web;

use App\Transformers\Datum;
use App\Transformers\Inbound\WebTransformer;

class Article extends WebTransformer
{

    use HasBlocks { getExtraFields as getBlockFields;
    }

    protected function getTitle(Datum $datum)
    {
        return [
            'title' => $datum->slug,
        ];
    }

    protected function getExtraFields(Datum $datum)
    {
        return array_merge($this->getBlockFields($datum), [
            'date' => $datum->date('date'),
            'agent_ids' => collect($datum->related)->where('type', 'artists')->pluck('id')->all(),

            // TODO: Move these to trait?
            'publish_start_date' => $datum->date('publish_start_date'),
            'publish_end_date' => $datum->date('publish_end_date'),
        ]);
    }
}
