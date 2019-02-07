<?php

namespace App\Models;

use App\Models\BaseModel as BaseModel;

class LibraryModel extends BaseModel
{

    protected static $source = 'Library';

    protected $primaryKey = 'id';

    // TODO: Add seeders for these models
    // protected $fakeIdsStartAt = 9990000;

    protected $hasSourceDates = false;

}
