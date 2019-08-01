<?php

namespace App\Models\Shop;

use App\Models\ShopModel;

/**
 * Tag-like classifications of shop products.
 */
class Category extends ShopModel
{

    public $table = 'shop_categories';

    protected $primaryKey = 'shop_id';

    public function parent()
    {
        return $this->belongsTo('App\Models\Shop\Category', 'parent_category_shop_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Shop\Category', 'parent_category_shop_id');
    }

    /**
     * Returns web link to the category
     *
     * @return string
     */
    public function getWebUrlAttribute()
    {
        return env('SHOP_CATEGORY_URL') . $this->shop_id;
    }

}
