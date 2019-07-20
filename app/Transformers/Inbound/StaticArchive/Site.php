<?php

namespace App\Transformers\Inbound\StaticArchive;

use App\Transformers\Datum;
use App\Transformers\Inbound\BaseTransformer;

class Site extends BaseTransformer
{

    protected function getIds(Datum $datum)
    {

        return [
            'site_id' => $datum->id,
        ];

    }

    protected function getExtraFields(Datum $datum)
    {

        return [
            'web_url' => $datum->link,
        ];

    }

    protected function getSync(Datum $datum)
    {

        return [
            'agents' => $datum->all('agent_ids'),
            'artworks' => $datum->all('artwork_ids'),
            'exhibitions' => $datum->all('exhibition_ids'),
        ];

    }

}
