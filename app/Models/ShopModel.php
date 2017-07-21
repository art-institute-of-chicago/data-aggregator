<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\SolrSearchable;

class ShopModel extends BaseModel
{

    use SolrSearchable;

    protected $primaryKey = 'shop_id';
    protected $dates = ['source_created_at', 'source_modified_at'];

}
