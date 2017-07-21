<?php

namespace App\Models\Shop;

use App\Models\ShopModel;

class Product extends ShopModel
{

    public function categories()
    {

        return $this->belongsToMany('App\Models\Shop\Category', 'product_shop_category');

    }

}
