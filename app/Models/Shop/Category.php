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
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            'link' => [
                "doc" => "URL to the shop page for this category",
                "value" => function() { return $this->link; },
            ],
            'parent_id' => [
                "doc" => "Unique identifier of this category's parent",
                "value" => function() { return $this->parent_category_shop_id; },
            ],
            'type' => [
                "doc" => "The type of category, e.g., sale, place-of-origin, style, etc.",
                "value" => function() { return $this->type; },
            ],
            'source_id' => [
                "doc" => "The identifier from the source system. This is only unique relative to the type of category, so we don't use this as the primary identifier.",
                "value" => function() { return $this->source_id; },
            ],
            'child_ids' => [
                "doc" => "Unique identifier of this category's children",
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

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "377";

    }

}
