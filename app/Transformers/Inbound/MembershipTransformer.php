<?php

namespace App\Transformers\Inbound;

use App\Transformers\Datum;

class MembershipTransformer extends BaseTransformer
{

    protected function getIds(Datum $datum)
    {
        return [
            'membership_id' => $datum->id,
        ];
    }
}
