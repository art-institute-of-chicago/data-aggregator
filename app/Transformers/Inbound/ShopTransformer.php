<?php

namespace App\Transformers\Inbound;

use App\Transformers\Datum;

class ShopTransformer extends BaseTransformer
{

    protected function getIds(Datum $datum)
    {

        return [
            'shop_id' => $datum->id,
        ];

    }

}
