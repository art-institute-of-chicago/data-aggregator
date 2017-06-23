<?php

namespace App\Shop;

class Product extends ShopModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['shop_id', 'title'];
    

    public function categories()
    {

        return $this->belongsToMany('App\Shop\Category', 'product_shop_category');

    }

}
