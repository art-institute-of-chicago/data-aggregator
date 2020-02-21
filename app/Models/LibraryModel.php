<?php

namespace App\Models;

use App\Models\BaseModel as BaseModel;

class LibraryModel extends BaseModel
{

    protected static $source = 'Library';

    protected $primaryKey = 'id';

    protected $hasSourceDates = false;

}
