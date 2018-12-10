<?php

namespace App\Models\Shop;

use App\Models\ShopModel;

/**
 * An item available for purchase in the museum shop.
 */
class Product extends ShopModel
{

    protected $casts = [
        'aic_collection' => 'boolean',
        'gift_box' => 'boolean',
        'holiday' => 'boolean',
        'architecture' => 'boolean',
        'glass' => 'boolean',
        'choking_hazard' => 'boolean',
        'back_order' => 'boolean',
        'active' => 'boolean',
    ];

    public function artists()
    {

        return $this->belongsToMany('App\Models\Collections\Agent', 'artist_product');

    }


    /**
     * Returns web link to the product
     *
     * @return string
     */
    public function getWebUrlAttribute()
    {

        return env('PRODUCT_URL') .$this->shop_id;

    }

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'title_sort',
                "doc" => "The sortable version of the name of this product",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->title_sort; },
            ],
            [
                "name" => 'parent_id',
                "doc" => "Unique identifier of this product's parent",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->parent_id; },
            ],
            [
                "name" => 'category_id',
                "doc" => "Identifier of this product's category",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->category_id; },
            ],
            [
                "name" => 'sku',
                "doc" => "Numeric product identification code of a machine-readable bar code",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->sku; },
            ],
            [
                "name" => 'external_sku',
                "doc" => "Numeric product identification code of a machine-readable bar code, when the customer sku differs from our internal one",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->external_sku; },
            ],
            [
                "name" => 'image_url',
                "doc" => "URL of an image for this product",
                "type" => "url",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return str_replace(env('SHOP_IMAGE_URL'), env('SHOP_IMGIX_URL'), $this->image_url); },
            ],
            [
                "name" => 'web_url',
                "doc" => "URL of this product in the shop",
                "type" => "url",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->web_url; },
            ],
            [
                "name" => 'description',
                "doc" => "Explanation of what this product is",
                "type" => "string",
                "elasticsearch" => [
                    "default" => true,
                    "type" => 'text',
                ],
                "value" => function() { return $this->description; },
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
                "name" => 'sale_price',
                "doc" => "Number indicating how much the product costs on sale to the customer",
                "type" => "number",
                'elasticsearch_type' => 'float',
                "value" => function() { return $this->sale_price; },
            ],
            [
                "name" => 'member_price',
                "doc" => "Number indicating how much the product costs members",
                "type" => "number",
                'elasticsearch_type' => 'float',
                "value" => function() { return $this->member_price; },
            ],
            [
                "name" => 'aic_collection',
                "doc" => "Whether the item is an AIC product",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->aic_collection; },
            ],
            [
                "name" => 'gift_box',
                "doc" => "Whether the item can be wrapped in a gift box",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->gift_box; },
            ],
            [
                "name" => 'recipient',
                "doc" => "Category indicating who the product is intended for. E.g., 'Anyone', 'ForHim', 'ForHer', etc.",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->recipient; },
            ],
            [
                "name" => 'holiday',
                "doc" => "Whether the product is a holiday item",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->holiday; },
            ],
            [
                "name" => 'architecture',
                "doc" => "Whether the product is an architectural item",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->architecture; },
            ],
            [
                "name" => 'glass',
                "doc" => "Whether the item is glass",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->glass; },
            ],
            [
                "name" => 'x_shipping_charge',
                "doc" => "Number indicating the additional shipping charge for this item, in US Dollars.",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->x_shipping_charge; },
            ],
            [
                "name" => 'inventory',
                "doc" => "Number indicating how many items remain in our inventory",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->inventory; },
            ],
            [
                "name" => 'choking_hazard',
                "doc" => "Whether this product is a choking hazard",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->choking_hazard; },
            ],
            [
                "name" => 'back_order',
                "doc" => "Whether this product has been back ordered",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->back_order; },
            ],
            [
                "name" => 'back_order_due_date',
                "doc" => "Date representing when this item is expected to be back in stock",
                "type" => "date",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->back_order_due_date; },
            ],
            [
                "name" => 'artist_ids',
                "doc" => "Unique identifiers of the artists represented in this item",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->artists()->pluck('agent_citi_id'); },
            ],
            [
                "name" => 'is_active',
                "doc" => "Whether this product is currently available on the shop website",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->active; },
            ],
        ];

    }

}
