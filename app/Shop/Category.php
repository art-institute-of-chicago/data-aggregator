<?php

namespace App\Shop;

class Category extends ShopModel
{

    public $incrementing = false;
    protected $primaryKey = 'shop_id';
    protected $dates = ['api_created_at', 'api_modified_at', 'api_indexed_at'];
    public $table = 'shop_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['shop_id', 'title', 'link', 'type', 'source_id'];
    

    public function parent()
    {

        return $this->belongsTo('App\Shop\Category', 'parent_category_shop_id');

    }

    public function children()
    {

        return $this->hasMany('App\Shop\Category', 'parent_category_shop_id');

    }

}
