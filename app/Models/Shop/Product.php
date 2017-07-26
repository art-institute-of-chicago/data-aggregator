<?php

namespace App\Models\Shop;

use App\Models\ShopModel;

class Product extends ShopModel
{

    public function categories()
    {

        return $this->belongsToMany('App\Models\Shop\Category', 'product_shop_category');

    }


    /**
     * Turn this model object into a generic array.
     *
     * @param boolean  $withTitles
     * @return array
     */
    public function transformFields()
    {

        return [
            'title_display' => $this->title_display,
            'sku' => $this->sku,
            'link' => $this->link,
            'image' => $this->image,
            'description' => $this->description,
            'is_on_sale' => (bool) $this->on_sale,
            'priority' => $this->priority,
            'price' => $this->price,
            'review_count' => $this->review_count,
            'item_sold' => $this->item_sold,
            'rating' => $this->rating,
            'category_ids' => $this->categories->pluck('shop_id')->all(),
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

}
