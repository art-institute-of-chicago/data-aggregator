<?php

namespace App\Models;

use App\Models\BaseModel;

class MobileModel extends BaseModel
{

    protected static $source = 'Mobile';

    protected $primaryKey = 'mobile_id';

    protected $dates = [
        'source_created_at',
        'source_modified_at',
    ];

    protected $fakeIdsStartAt = 9990000;

}
