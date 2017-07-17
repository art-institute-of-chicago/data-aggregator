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
            'source' => $this->searchableSource(),
            'model' => $this->searchableModel(),
            'source_id' => $this->shop_id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'link' => $this->link,
        ];

        return $array;

    }

}
