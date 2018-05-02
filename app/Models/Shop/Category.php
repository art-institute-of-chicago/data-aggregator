<?php

namespace App\Models\Shop;

use App\Models\ShopModel;
use App\Models\Documentable;

/**
 * Tag-like classifications of shop products.
 */
class Category extends ShopModel
{

    use Documentable;

    public $table = 'shop_categories';

    protected $apiCtrl = 'ShopCategoriesController';

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

        return env('SHOP_CATEGORY_URL') .$this->shop_id;

    }

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'web_url',
                "doc" => "URL to the shop page for this category",
                "type" => "url",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->web_url; },
            ],
            [
                "name" => 'parent_id',
                "doc" => "Unique identifier of this category's parent",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->parent->shop_id ?? null; },
            ],
            [
                "name" => 'child_ids',
                "doc" => "Unique identifiers of this category's children",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->children->pluck('shop_id')->all(); },
            ],
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

            [
                "name" => 'parent_title',
                "doc" => "Name of this category's parent",
                "type" => "string",
                "elasticsearch_type" => "text",
                "value" => function() { return $this->parent->title ?? null; },
            ],
            [
                "name" => 'child_titles',
                "doc" => "Names of this category's children",
                "type" => "array",
                "elasticsearch_type" => "text",
                "value" => function() { return $this->children->pluck('title')->all(); },
            ],

        ];

    }

    public function getExtraFillFieldsFrom($source)
    {

        return [
            'parent_category_shop_id' => $source->parent_id,
        ];

    }

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "2";

    }

}
