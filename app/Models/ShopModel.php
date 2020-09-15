<?php

namespace App\Models;

class ShopModel extends BaseModel
{

    use ElasticSearchable;

    protected static $source = 'Shop';

    protected $primaryKey = 'shop_id';
}
