<?php

namespace App\Shop;

class Category extends ShopModel
{

    public $incrementing = false;
    protected $primaryKey = 'shop_id';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at'];
    public $table = 'shop_categories';
    

    public function parent()
    {

        return $this->belongsTo('App\Shop\Category', 'parent_category_shop_id');

    }

    public function children()
    {

        return $this->hasMany('App\Shop\Category', 'parent_category_shop_id');

    }

}
