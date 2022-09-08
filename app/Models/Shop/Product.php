<?php

namespace App\Models\Shop;

use App\Models\ShopModel;

/**
 * An item available for purchase in the museum shop.
 */
class Product extends ShopModel
{
    public function artists()
    {
        return $this->belongsToMany('App\Models\Collections\Agent', 'artist_product');
    }

    public function artworks()
    {
        return $this->belongsToMany('App\Models\Collections\Artwork', 'artwork_product');
    }

    public function exhibitions()
    {
        return $this->belongsToMany('App\Models\Collections\Exhibition', 'exhibition_product');
    }
}
