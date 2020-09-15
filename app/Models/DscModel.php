<?php

namespace App\Models;

class DscModel extends BaseModel
{

    protected static $source = 'Dsc';

    protected $primaryKey = 'dsc_id';

    protected $hasSourceDates = false;
}
