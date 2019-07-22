<?php

namespace App\Transformers\Inbound\Shop;

use App\Transformers\Datum;
use App\Transformers\Inbound\ShopTransformer;

class Category extends ShopTransformer
{

    protected function getExtraFields(Datum $datum)
    {
        return [
            'parent_category_shop_id' => $datum->parent_id,
        ];
    }

}
