<?php

namespace App\Models;

use App\Models\BaseModel;

class DscModel extends BaseModel
{

    protected static $source = 'Dsc';

    protected $primaryKey = 'dsc_id';

    protected $dates = ['source_created_at', 'source_modified_at'];

}
