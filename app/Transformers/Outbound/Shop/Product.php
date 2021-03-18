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
            'price_display' => [
                'doc' => 'Explanation of what this product is',
                'type' => 'string',
                'elasticsearch' => 'text',
                'value' => function ($item) {
                    $out = '<p>';

                    if ($item->min_current_price < $item->max_current_price) {
                        $out .=  'From ';
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
                    return $item->artists->pluck('agent_citi_id');
                },
            ],
            'artwork_ids' => [
                'doc' => 'Unique identifiers of the artworks associated with this product',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->artworks->pluck('artwork_citi_id');
                },
            ],
            'exhibition_ids' => [
                'doc' => 'Unique identifiers of the exhibitions associated with this product',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->exhibitions->pluck('exhibition_citi_id');
                },
            ],
        ];
    }
}
