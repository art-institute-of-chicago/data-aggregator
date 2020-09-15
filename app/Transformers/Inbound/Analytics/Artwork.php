<?php

namespace App\Transformers\Inbound\Analytics;

use App\Transformers\Datum;
use App\Transformers\Inbound\BaseTransformer;

class Artwork extends BaseTransformer
{

    protected function getTitle(Datum $datum)
    {
        return [];
    }

    protected function getDates(Datum $datum)
    {
        return [];
    }

    protected function getExtraFields(Datum $datum)
    {
        return [
            'pageviews' => $datum->pageviews,
            'pageviews_recent' => $datum->pageviews_recent,
        ];
    }
}
