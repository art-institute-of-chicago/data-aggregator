<?php

namespace App\Transformers\Inbound\Shop;

use App\Transformers\Datum;
use App\Transformers\Inbound\ShopTransformer;

class Product extends ShopTransformer
{
    protected function getSync(Datum $datum)
    {
        return [
            'artists' => $datum->artist_ids ?? [],
        ];
    }
}
