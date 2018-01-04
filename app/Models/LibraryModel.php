<?php

namespace App\Models;

use Aic\Hub\Foundation\AbstractModel as BaseModel;

class LibraryModel extends BaseModel
{

    use Fillable;

    protected static $source = 'Library';

    protected $primaryKey = 'id';

    // TODO: Add seeders for these models
    // protected $fakeIdsStartAt = 9990000;

    // TODO: Centralize source date logic. This conflicts with Fillable
    // protected $hasSourceDates = false;

}
