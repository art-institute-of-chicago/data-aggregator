<?php

namespace App\Transformers\Outbound\Shop;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Product extends BaseTransformer
{

    protected function getFields()
    {
        return [
            'title_sort' => [
                'doc' => 'The sortable version of the name of this product',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'is_active' => [
                'doc' => 'Whether this product is currently available on the shop\'s website',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
                'value' => function ($item) {
                    return $item->active;
                },
            ],
            'parent_id' => [
                'doc' => 'Unique identifier of this product\'s parent',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'category_id' => [
                'doc' => 'Identifier of this product\'s category',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'sku' => [
                'doc' => 'Numeric product identification code of a machine-readable barcode',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'external_sku' => [
                'doc' => 'Numeric product identification code of a machine-readable barcode, when the customer sku differs from our internal one',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'image_url' => [
                'doc' => 'URL of an image for this product',
                'type' => 'url',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return str_replace(env('SHOP_IMAGE_URL'), env('SHOP_IMGIX_URL'), $item->image_url);
                },
            ],
            'web_url' => [
                'doc' => 'URL of this product in the shop',
                'type' => 'url',
                'elasticsearch' => 'keyword',
            ],
            'description' => [
                'doc' => 'Explanation of what this product is',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                    'type' => 'text',
                ],
            ],
            'priority' => [
                'doc' => 'Used for sorting in the shop\'s website, specifically in the \'Featured\' sort mode, which is the default. This sort mode is two-part: first, items are sorted by their `priority` ascending; then as a secondary step, items are sorted by the number of items sold, descending.',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'price' => [
                'doc' => 'Number indicating how much the product costs the customer',
                'type' => 'number',
                'elasticsearch' => 'float',
            ],
            'sale_price' => [
                'doc' => 'Number indicating how much the product costs on sale to the customer',
                'type' => 'number',
                'elasticsearch' => 'float',
            ],
            'member_price' => [
                'doc' => 'Number indicating how much the product costs members',
                'type' => 'number',
                'elasticsearch' => 'float',
            ],
            'aic_collection' => [
                'doc' => 'Whether the item is an AIC product',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'gift_box' => [
                'doc' => 'Whether the item can be wrapped in a gift box',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'recipient' => [
                'doc' => 'Category indicating who the product is intended for. E.g., "Anyone", "ForHim", "ForHer", etc.',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'holiday' => [
                'doc' => 'Whether the product is a holiday item',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'architecture' => [
                'doc' => 'Whether the product is an architectural item',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'glass' => [
                'doc' => 'Whether the item is glass',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'x_shipping_charge' => [
                'doc' => 'Number indicating the additional shipping charge for this item, in US Dollars.',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'inventory' => [
                'doc' => 'Number indicating how many items remain in our inventory',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'choking_hazard' => [
                'doc' => 'Whether this product is a choking hazard',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'back_order' => [
                'doc' => 'Whether this product has been back ordered',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'back_order_due_date' => [
                'doc' => 'Date representing when this item is expected to be back in stock',
                'type' => 'date',
                'elasticsearch' => 'date',
            ],

            // TODO: Refactor relationships:
            'artist_ids' => [
                'doc' => 'Unique identifiers of the artists represented in this item',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->artists->pluck('agent_citi_id');
                },
            ],
        ];
    }

}
