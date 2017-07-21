<?php

namespace App\Models\Shop;

use App\Models\ShopModel;

class Product extends ShopModel
{

    public function categories()
    {

        return $this->belongsToMany('App\Models\Shop\Category', 'product_shop_category');

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
