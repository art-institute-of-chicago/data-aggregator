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
            [
                "name" => 'link',
                "doc" => "URL to the shop page for this category",
                "type" => "url",
                "value" => function() { return $this->link; },
            ],
            [
                "name" => 'parent_id',
                "doc" => "Unique identifier of this category's parent",
                "type" => "number",
                "value" => function() { return $this->parent ? $this->parent->shop_id : null; },
            ],
            [
                "name" => 'type',
                "doc" => "The type of category, e.g., sale, place-of-origin, style, etc.",
                "type" => "string",
                "value" => function() { return $this->type; },
            ],
            [
                "name" => 'source_id',
                "doc" => "The identifier from the source system. This is only unique relative to the type of category, so we don't use this as the primary identifier.",
                "type" => "number",
                "value" => function() { return $this->source_id; },
            ],
            [
                "name" => 'child_ids',
                "doc" => "Unique identifier of this category's children",
                "type" => "array",
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

        return "999397";

    }

}
