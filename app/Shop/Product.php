<?php

namespace App\Shop;

class Product extends ShopModel
{

    public function categories()
    {

        return $this->belongsToMany('App\Shop\Category', 'product_shop_category');

    }

}
