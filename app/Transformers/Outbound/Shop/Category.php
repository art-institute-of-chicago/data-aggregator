<?php

namespace App\Transformers\Outbound\Shop;

use App\Transformers\Outbound\Shop\Category as ShopCategoryTransformer;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Category extends BaseTransformer
{

    protected $availableIncludes = ['children'];

    public function includeChildren($category)
    {
        return $this->collection($category->children, new ShopCategoryTransformer(), false);
    }

    protected function getFields()
    {
        return [
            'web_url' => [
                'doc' => 'URL to the shop page for this category',
                'type' => 'url',
                'elasticsearch' => 'keyword',
            ],

            // TODO: Refactor relationships:
            'parent_id' => [
                'doc' => 'Unique identifier of this category\'s parent',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->parent->shop_id ?? null;
                },
            ],
            'parent_title' => [
                'doc' => 'Name of this category\'s parent',
                'type' => 'string',
                'elasticsearch' => 'text',
                'value' => function ($item) {
                    return $item->parent->title ?? null;
                },
            ],
            'child_ids' => [
                'doc' => 'Unique identifiers of this category\'s children',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->children->pluck('shop_id');
                },
            ],
            'child_titles' => [
                'doc' => 'Names of this category\'s children',
                'type' => 'array',
                'elasticsearch' => 'text',
                'value' => function ($item) {
                    return $item->children->pluck('title');
                },
            ],
        ];
    }
}
