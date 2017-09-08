<?php

namespace App\Models;

use App\Models\BaseModel;

class MobileModel extends BaseModel
{

    protected $source = 'Mobile';

    protected $primaryKey = 'mobile_id';

    protected $dates = ['source_created_at', 'source_modified_at'];

}
