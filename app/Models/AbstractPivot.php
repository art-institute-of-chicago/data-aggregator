<?php

namespace App\Models;

use App\Models\Fillable;
use App\Models\Instancable;
use App\Models\Transformable;
use App\Models\Fakeable;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AbstractPivot extends Pivot
{

    use Fillable, Instancable, Transformable, Fakeable;

}
