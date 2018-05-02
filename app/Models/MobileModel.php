<?php

namespace App\Models;

use App\Models\BaseModel;

class MobileModel extends BaseModel
{

    protected static $source = 'Mobile';

    protected $primaryKey = 'mobile_id';

    protected $hasSourceDates = false;

    protected $fakeIdsStartAt = 9990000;

}
