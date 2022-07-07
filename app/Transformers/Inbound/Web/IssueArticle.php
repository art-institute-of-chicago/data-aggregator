<?php

namespace App\Transformers\Inbound\Web;

use App\Transformers\Datum;
use App\Transformers\Inbound\WebTransformer;

class IssueArticle extends WebTransformer
{
    use HasBlocks {
        getExtraFields as getBlockFields;
    }

    protected function getExtraFields(Datum $datum)
    {
        return array_merge($this->getBlockFields($datum), [
            'date' => $datum->date('date'),

            // TODO: Move these to trait?
            'is_published' => $datum->is_published ?? $datum->published,
            'publish_start_date' => $datum->date('publish_start_date'),
            'publish_end_date' => $datum->date('publish_end_date'),
        ]);
    }
}
