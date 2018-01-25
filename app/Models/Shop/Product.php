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
            [
                "name" => 'title_display',
                "doc" => "HTML prettified version of the title",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->title_display; },
            ],
            [
                "name" => 'sku',
                "doc" => "Numeric product identification code of a machine-readable bar code",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->sku; },
            ],
            [
                "name" => 'link',
                "doc" => "URL to the item in the shop",
                "type" => "url",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->link; },
            ],
            [
                "name" => 'image',
                "doc" => "URL of an image for this product",
                "type" => "url",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->image; },
            ],
            [
                "name" => 'description',
                "doc" => "Explanation of what this product is",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->description; },
            ],
            [
                "name" => 'is_on_sale',
                "doc" => "Whether this product us on sale",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return (bool) $this->on_sale; },
            ],
            [
                "name" => 'priority',
                "doc" => "Used for sorting in the shop website, specifically in the \"Featured\" sort mode, which is the default. This sort mode is two-part: first, items are sorted by their `priority` ascending; then as a secondary step, items are sorted by the number of items sold, descending.",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->priority; },
            ],
            [
                "name" => 'price',
                "doc" => "Number indicating how much the product costs the customer",
                "type" => "number",
                'elasticsearch_type' => 'float',
                "value" => function() { return $this->price; },
            ],
            [
                "name" => 'review_count',
                "doc" => "Number indicating how many reviews this product has",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->review_count; },
            ],
            [
                "name" => 'item_sold',
                "doc" => "Number indicating how many items of this product have been sold",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->item_sold; },
            ],
            [
                "name" => 'rating',
                "doc" => "Floating number representing the average rating this product has received",
                "type" => "number",
                'elasticsearch_type' => 'float',
                "value" => function() { return $this->rating; },
            ],
            [
                "name" => 'category_ids',
                "doc" => "Unique identifier of the categories associated with this product",
                "type" => "array",
                'elasticsearch_type' => 'integer',
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

            [
                "name" => 'category_titles',
                "doc" => "Names of the categories associated with this product",
                "type" => "array",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->categories->pluck('title')->all(); },
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

        return "999686";

    }

}
