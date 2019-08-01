<?php

namespace App\Models;

class DscModel extends BaseModel
{

    protected static $source = 'Dsc';

    protected $primaryKey = 'dsc_id';

    protected $fakeIdsStartAt = 9990000;

    protected $hasSourceDates = false;

}
