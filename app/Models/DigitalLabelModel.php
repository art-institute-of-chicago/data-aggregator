<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\ElasticSearchable;

class DigitalLabelModel extends BaseModel
{

    use ElasticSearchable;

    protected static $source = 'DigitalLabel';

    protected $primaryKey = 'id';

}
