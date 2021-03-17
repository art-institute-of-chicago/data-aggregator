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
