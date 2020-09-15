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
        'active' => 'boolean',
        'source_created_at' => 'datetime',
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
        return env('PRODUCT_URL') . $this->shop_id;
    }
}
