<?php

namespace App\Models\Archive;

use Aic\Hub\Foundation\AbstractModel as BaseModel;
use App\Models\Fillable;

class ArchivalImage extends BaseModel
{

    use Fillable;

    protected $dates = ['source_created_at', 'source_modified_at'];

    protected static $source = 'Archive';

    protected $primaryKey = 'id';

    protected $fakeIdsStartAt = 999000;

}