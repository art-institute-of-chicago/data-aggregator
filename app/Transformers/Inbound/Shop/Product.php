<?php

namespace App\Transformers\Inbound\Shop;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\Datum;
use App\Transformers\Inbound\ShopTransformer;

class Product extends ShopTransformer
{
    public function shouldSave(Model $instance, $datum, $isNew = null)
    {
        return !empty($datum['title']);
    }

    protected function getDates(Datum $datum)
    {
        return [
            'source_updated_at' => $datum->load_date,
        ];
    }

    protected function getExtraFields(Datum $datum)
    {
        return [
            'min_compare_at_price' => (float) ($datum->min_compare_at_price),
            'max_compare_at_price' => (float) ($datum->max_compare_at_price),
            'min_current_price' => (float) ($datum->min_current_price),
            'max_current_price' => (float) ($datum->max_current_price),
        ];
    }

    protected function getSync(Datum $datum)
    {
        return [
            'artists' => array_values(array_filter(explode(',', $datum->artist_ids))),
            'artworks' => array_values(array_filter(explode(',', $datum->artwork_ids))),
            'exhibitions' => array_values(array_filter(explode(',', $datum->exhibition_ids))),
        ];
    }
}
