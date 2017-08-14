<?php

namespace App\Models\Shop;

use App\Models\ShopModel;

class Category extends ShopModel
{

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


    /**
     * Turn this model object into a generic array.
     *
     * @param boolean  $withTitles
     * @return array
     */
    public function transformFields()
    {

        return [
            'link' => $this->link,
            'parent_id' => $this->parent_category_shop_id,
            'type' => $this->type,
            'source_id' => $this->source_id,
            'child_ids' => $this->children->pluck('shop_id')->all(),
        ];

    }


    /**
     * Turn the titles for related models into a generic array
     *
     * @return array
     */
    protected function transformTitles()
    {

        return [

            'parent_title' => $this->parent ? $this->parent->title : NULL,
            'child_titles' => $this->children->pluck('title')->all(),

        ];

    }


    /**
     * Generate model-specific fields for an array representing the schema for this object.
     *
     * @return array
     */
    public function elasticsearchMappingFields()
    {

        return
            [
                'link' => [
                    'type' => 'keyword',
                ],
                'parent_id' => [
                    'type' => 'integer',
                ],
                'parent_title' => [
                    'type' => 'text',
                ],
                'type' => [
                    'type' => 'keyword',
                ],
                'source_id' => [
                    'type' => 'integer',
                ],
                'child_ids' => [
                    'type' => 'integer',
                ],
                'child_titles' => [
                    'type' => 'text',
                ],
            ];

    }

}
