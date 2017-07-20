<?php

namespace App\Shop;

class Product extends ShopModel
{

    public function categories()
    {

        return $this->belongsToMany('App\Shop\Category', 'product_shop_category');

    }

    public function toSearchableArray()
    {

        $array = [
            'id' => $this->searchableId(),
            'api_id' => $this->getKey(),
            'api_model' => $this->searchableModel(),
            'api_link' => $this->searchableLink(),
            'title' => $this->title,
        ];

        return $array;

    }

}
