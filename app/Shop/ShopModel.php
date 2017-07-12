<?php

namespace App\Shop;

use Illuminate\Database\Eloquent\Model;

class ShopModel extends Model
{

    public $incrementing = false;
    protected $primaryKey = 'shop_id';
    protected $dates = ['source_created_at', 'source_modified_at'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

}
