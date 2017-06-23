<?php

namespace App\Shop;

use Illuminate\Database\Eloquent\Model;

class ShopModel extends Model
{

    public $incrementing = false;
    protected $primaryKey = 'shop_id';
    protected $dates = ['api_created_at', 'api_modified_at', 'api_indexed_at'];

}
