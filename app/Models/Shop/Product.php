<?php

namespace App\Models\Shop;

use App\Models\ShopModel;
use App\Models\Documentable;

/**
 * An item available for purchase in the museum shop.
 */
class Product extends ShopModel
{

    use Documentable;

    public function categories()
    {

        return $this->belongsToMany('App\Models\Shop\Category', 'product_shop_category');

    }


    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            'title_display' => [
                "doc" => "HTML prettified version of the title",
                "value" => function() { return $this->title_display; },
            ],
            'sku' => [
                "doc" => "Numeric product identification code of a machine-readable bar code",
                "value" => function() { return $this->sku; },
            ],
            'link' => [
                "doc" => "URL to the item in the shop",
                "value" => function() { return $this->link; },
            ],
            'image' => [
                "doc" => "URL of an image for this product",
                "value" => function() { return $this->image; },
            ],
            'description' => [
                "doc" => "Explanation of what this product is",
                "value" => function() { return $this->description; },
            ],
            'is_on_sale' => [
                "doc" => "Whether this product us on sale",
                "value" => function() { return (bool) $this->on_sale; },
            ],
            'priority' => [
                "doc" => "We are unclear as to the purpose of this numeric field",
                "value" => function() { return $this->priority; },
            ],
            'price' => [
                "doc" => "Number indicating how much the product costs the customer",
                "value" => function() { return $this->price; },
            ],
            'review_count' => [
                "doc" => "Number indicating how many reviews this product has",
                "value" => function() { return $this->review_count; },
            ],
            'item_sold' => [
                "doc" => "Number indicating how many items of this product have been sold",
                "value" => function() { return $this->item_sold; },
            ],
            'rating' => [
                "doc" => "Floating number representing the average rating this product has received",
                "value" => function() { return $this->rating; },
            ],
            'category_ids' => [
                "doc" => "Unique identifier of the categories associated with this product",
                "value" => function() { return $this->categories->pluck('shop_id')->all(); },
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

            'category_titles' => $this->categories->pluck('title')->all(),

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
                'title_display' => [
                    'type' => 'text',
                ],
                'sku' => [
                    'type' => 'keyword',
                ],
                'link' => [
                    'type' => 'keyword',
                ],
                'image' => [
                    'type' => 'keyword',
                ],
                'is_on_sale' => [
                    'type' => 'boolean',
                ],
                'priority' => [
                    'type' => 'integer',
                ],
                'price' => [
                    'type' => 'float',
                ],
                'review_count' => [
                    'type' => 'integer',
                ],
                'item_sold' => [
                    'type' => 'integer',
                ],
                'rating' => [
                    'type' => 'float',
                ],
                'category_ids' => [
                    'type' => 'integer',
                ],
                'category_titles' => [
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

        return "797";

    }

}
