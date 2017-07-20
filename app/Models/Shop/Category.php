<?php

namespace App\Models\Shop;

class Category extends ShopModel
{

    public $incrementing = false;
    protected $primaryKey = 'shop_id';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at'];
    public $table = 'shop_categories';

    protected $apiCtrl = 'ShopCategoriesController';

    public function parent()
    {

        return $this->belongsTo('App\Models\Shop\Category', 'parent_category_shop_id');

    }

    public function children()
    {

        return $this->hasMany('App\Models\Shop\Category', 'parent_category_shop_id');

    }

    protected function searchableModel()
    {

        return 'shop-categories';

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
