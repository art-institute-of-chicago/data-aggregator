<?php

namespace App\Models;

class MobileModel extends BaseModel
{

    protected static $source = 'Mobile';

    protected $primaryKey = 'mobile_id';

    protected $hasSourceDates = false;
}
