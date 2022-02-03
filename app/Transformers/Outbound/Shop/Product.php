<?php

namespace App\Transformers\Outbound\Shop;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Product extends BaseTransformer
{

    protected function getFields()
    {
        return [
            'external_sku' => [
                'doc' => 'Numeric product identification code of a machine-readable barcode, when the customer sku differs from our internal one',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'image_url' => [
                'doc' => 'URL of an image for this product',
                'type' => 'url',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return env('SHOP_IMGIX_URL') . $item->external_sku . '_2.jpg';
                },
            ],
            'web_url' => [
                'doc' => 'URL of this product in the shop',
                'type' => 'url',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return env('SHOP_PRODUCT_URL') . $item->external_sku;
                },
            ],
            'description' => [
                'doc' => 'Explanation of what this product is',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                ],
            ],
            'price_display' => [
                'doc' => 'Explanation of what this product is',
                'type' => 'string',
                'elasticsearch' => 'text',
                'value' => function ($item) {
                    if (!isset($item->min_current_price)) {
                        return;
                    }

                    $out = '<p>';

                    if ($item->min_current_price < $item->max_current_price) {
                        $out .= 'From ';
                    }

                    $out .= '$' . $item->min_current_price;

                    if (isset($item->min_compare_at_price)) {
                        $out .= ' <s>$' . $item->min_compare_at_price . '</s>';
                    }

                    $out .= '</p>';

                    return $out;
                },
            ],
            'min_compare_at_price' => [
                'doc' => 'Number indicating how much the least expensive variant of a product cost before a sale',
                'type' => 'number',
                'elasticsearch' => 'float',
            ],
            'max_compare_at_price' => [
                'doc' => 'Number indicating how much the most expensive variant of a product cost before a sale',
                'type' => 'number',
                'elasticsearch' => 'float',
            ],
            'min_current_price' => [
                'doc' => 'Number indicating how much the least expensive variant of a product costs right now',
                'type' => 'number',
                'elasticsearch' => 'float',
            ],
            'max_current_price' => [
                'doc' => 'Number indicating how much the most expensive variant of a product costs right now',
                'type' => 'number',
                'elasticsearch' => 'float',
            ],

            // TODO: Refactor relationships:
            'artist_ids' => [
                'doc' => 'Unique identifiers of the artists associated with this product',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->artists->pluck('citi_id');
                },
            ],
            'artwork_ids' => [
                'doc' => 'Unique identifiers of the artworks associated with this product',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->artworks->pluck('citi_id');
                },
            ],
            'exhibition_ids' => [
                'doc' => 'Unique identifiers of the exhibitions associated with this product',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->exhibitions->pluck('citi_id');
                },
            ],
        ];
    }
}
